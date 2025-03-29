<?php

namespace App\Models\Post;

use App\Models\Tag\Acting;
use App\Models\Tag\Field;
use App\Models\Tag\Tag;
use App\Models\Tag\TagType;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mokhosh\FilamentRating\Components\Rating;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasEmbed;
    use HasFactory;
    use HasRating;
    use HasTag;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        // Add global scope to order by release date by default
        static::addGlobalScope('published', function ($query) {
            $query->published();
        });

        // Save the published at date when the post is published
        self::saving(function ($post) {
            if ($post->isDirty('is_published')) {
                $post->published_at = $post->is_published ? now() : null;
            }
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'release_date' => 'date',
        'rating' => 'float',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Scope a query to only include latest posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get the is new attribute.
     */
    protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['created_at'] > now()->subDays(5),
        );
    }

    /**
     * Get the thumb badge attribute.
     */
    protected function thumbBadge(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $this->is_new ? 'NEW' : '';
            }
        );
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Fit::Crop, 300, 300)
            ->nonQueued();

        $this->addMediaConversion('thumbnail')
            ->fit(Fit::Crop, 150, 150)
            ->nonQueued();
    }

    /**
     * Get the form for the post.
     */
    public static function getForm(): array
    {
        return [
            Section::make('Post Information')
                ->collapsible()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columns(1)
                        ->live(debounce: 1000)
                        ->afterStateUpdated(function ($state, callable $set) {
                            $set('slug', str()->slug($state));
                        }),
                    Forms\Components\TextInput::make('slug')
                        ->prefix('post/')
                        ->required()
                        ->maxLength(255)
                        ->columns(1)
                        ->dehydrateStateUsing(fn ($state) => str()->slug($state)),
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),
                    Fieldset::make('Publish Settings')
                        ->columns(2)
                        ->schema([
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->default(true),
                            Forms\Components\DateTimePicker::make('published_at')
                                ->readOnly(),
                        ]),
                    Fieldset::make('Advanced Filters')
                        ->columns(2)
                        ->schema([
                            Forms\Components\DatePicker::make('release_date')
                                ->native(false)
                                ->columns(1),
                            Rating::make('rating')
                                ->label('Rating')
                                ->dehydrated(false)
                                ->beforeStateDehydrated(function ($state, $record) {
                                    $record->postRatings()->updateOrCreate(
                                        ['user_id' => auth()->user()->id],
                                        ['rating' => $state]
                                    );
                                })
                                ->required()
                                ->stars(5),
                        ]),
                ]),
            Section::make('Media')
                ->collapsible()
                ->columns(2)
                ->schema([
                    Repeater::make('embeds')
                        ->label('Embed Videos')
                        ->relationship('embeds')
                        ->columnSpanFull()
                        ->columns(4)
                        ->schema([
                            Forms\Components\Select::make('type')
                                ->label('Type')
                                ->enum(EmbedType::class)
                                ->options(EmbedType::class)
                                ->default(EmbedType::YOUTUBE)
                                ->preload(),
                            Forms\Components\TextInput::make('embed')
                                ->label('Embed Video')
                                ->columnSpan(2)
                                ->placeholder('https://www.youtube.com/watch?v=...')
                                ->helperText('Enter the video ID'),
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->default(false),
                        ]),
                    SpatieMediaLibraryFileUpload::make('images')
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->reorderable()
                        ->responsiveImages()
                        ->collection('images')
                        ->disk('post')
                        ->imagePreviewHeight(150)
                    // ->imageResizeMode('cover')
                    // ->imageCropAspectRatio('1:1')
                    // ->imageResizeTargetWidth(300)
                    // ->imageResizeTargetHeight(300)
                    ,
                    SpatieMediaLibraryFileUpload::make('video')
                        ->Label('Videos')
                        ->multiple()
                        ->reorderable()
                        ->disk('post')
                        ->acceptedFileTypes([
                            'video/mp4',
                            'video/webm',
                            'video/ogg',
                            'video/avi',
                            'video/quicktime',
                            'video/x-ms-wmv',
                            'x-world/x-3dmf',
                            'application/vnd.sketchup.skp',
                        ]),
                ]),
            Section::make('Tags')
                ->collapsible()
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('genre')
                        ->label('Genre')
                        ->multiple()
                        ->searchable()
                        ->relationship('genre', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::GENRE->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('sub_genre')
                        ->label('Sub Genre')
                        ->multiple()
                        ->searchable()
                        ->relationship('subGenre', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::SUB_GENRE->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('director')
                        ->label('Director')
                        ->multiple()
                        ->searchable()
                        ->relationship('director', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::DIRECTOR->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('production')
                        ->label('Production')
                        ->multiple()
                        ->searchable()
                        ->relationship('production', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::PRODUCTION->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('writer')
                        ->label('Writer')
                        ->multiple()
                        ->searchable()
                        ->relationship('writer', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::WRITER->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('distribution')
                        ->label('Distribution')
                        ->multiple()
                        ->searchable()
                        ->relationship('distribution', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::DISTRIBUTION->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('language')
                        ->label('Language')
                        ->multiple()
                        ->searchable()
                        ->relationship('language', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::LANGUAGE->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('country')
                        ->label('Country')
                        ->multiple()
                        ->searchable()
                        ->relationship('country', 'name')
                        ->createOptionForm(Tag::getForm())
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::COUNTRY->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('year')
                        ->label('Year')
                        ->searchable()
                        ->relationship('year', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::YEAR->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('post_type')
                        ->label('Post Type')
                        ->searchable()
                        ->relationship('postType', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::POST_TYPE->value))
                        ->dehydrated(false),
                    Repeater::make('actingPivot')
                        ->relationship()
                        ->label('Acting')
                        ->columnSpanFull()
                        ->schema([
                            Grid::make('acting-grid')
                                ->label('Acting')
                                ->columns(7)
                                ->schema([
                                    Forms\Components\Select::make('tag_id')
                                        ->label('Actor')
                                        ->searchable()
                                        ->options(Acting::pluck('name', 'id'))
                                        ->required()
                                        ->createOptionForm(Tag::getFormForNoParents())
                                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::ACTING->value))
                                        ->columnSpan(3),
                                    Forms\Components\Select::make('custom.field')
                                        ->label('Field')
                                        ->enum(Field::class)
                                        ->options(Field::class)
                                        ->required()
                                        ->default(Field::AS),
                                    Forms\Components\TextInput::make('custom.value')
                                        ->label('Value')
                                        ->required()
                                        ->columnSpan(3),
                                ]),
                        ]),
                ]),
        ];
    }

    /**
     * Save the tag and parent and get the key.
     */
    protected static function saveTagAndParentAndGetKey(array $data, string $parentSlug): int
    {
        $tag = Tag::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
        ]);

        // Attach the acting parent
        $actingParent = Tag::where('slug', $parentSlug)->first();
        if ($actingParent) {
            $tag->parents()->attach($actingParent->getKey());
        }

        return $tag->getKey();
    }
}
