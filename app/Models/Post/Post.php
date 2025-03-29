<?php

namespace App\Models\Post;

use App\Models\Tag\Field;
use App\Models\Tag\Tag;
use App\Models\Tag\TagType;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mokhosh\FilamentRating\Components\Rating;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
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
     * Register media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Crop, 300, 300)
            ->nonQueued();

        $this
            ->addMediaConversion('thumbnail')
            ->fit(Fit::Crop, 150, 150)
            ->nonQueued();
    }

    /**
     * Get the embeds for the post.
     */
    public function embeds(): HasMany
    {
        return $this->hasMany(Embed::class);
    }

    /**
     * Get the tags for the post.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags')
            ->using(PostTag::class);
    }

    /**
     * Get the post tags for the post.
     */
    public function postTag(): HasMany
    {
        return $this->hasMany(PostTag::class);
    }

    /**
     * Get the acting pivot for the post.
     */
    public function actingPivot(): HasMany
    {
        return $this->postTag()->whereHas('acting');
    }

    /**
     * Get the directors for the post.
     */
    public function director(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::DIRECTOR->value);
        });
    }

    /**
     * Get the writers for the post.
     */
    public function writer(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::WRITER->value);
        });
    }

    /**
     * Get the production for the post.
     */
    public function production(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::PRODUCTION->value);
        });
    }

    /**
     * Get the actors for the post.
     */
    public function acting(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::ACTING->value);
        })->withPivot('custom');
    }

    /**
     * Get the countries for the post.
     */
    public function country(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::COUNTRY->value);
        });
    }

    /**
     * Get the languages for the post.
     */
    public function language(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::LANGUAGE->value);
        });
    }

    /**
     * Get the years for the post.
     */
    public function year(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::YEAR->value);
        });
    }

    /**
     * Get the sub genres for the post.
     */
    public function subGenre(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::SUB_GENRE->value);
        });
    }

    /**
     * Get the genres for the post.
     */
    public function genre(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::GENRE->value);
        });
    }

    /**
     * Get the post types for the post.
     */
    public function PostType(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::POST_TYPE->value);
        });
    }

    /**
     * Get the distributors for the post.
     */
    public function distribution(): BelongsToMany
    {
        return $this->tags()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::DISTRIBUTION->value);
        });
    }

    /**
     * Get the post ratings for the post.
     */
    public function postRatings(): HasMany
    {
        return $this->hasMany(PostRating::class);
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
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('sub_genre')
                        ->label('Sub Genre')
                        ->multiple()
                        ->searchable()
                        ->relationship('subGenre', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('director')
                        ->label('Director')
                        ->multiple()
                        ->searchable()
                        ->relationship('director', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('production')
                        ->label('Production')
                        ->multiple()
                        ->searchable()
                        ->relationship('production', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('writer')
                        ->label('Writer')
                        ->multiple()
                        ->searchable()
                        ->relationship('writer', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('distribution')
                        ->label('Distribution')
                        ->multiple()
                        ->searchable()
                        ->relationship('distribution', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('language')
                        ->label('Language')
                        ->multiple()
                        ->searchable()
                        ->relationship('language', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('country')
                        ->label('Country')
                        ->multiple()
                        ->searchable()
                        ->relationship('country', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('year')
                        ->label('Year')
                        ->searchable()
                        ->relationship('year', 'name')
                        ->createOptionForm(Tag::getForm())
                        // this is to make the post type a single select
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                        ->dehydrated(false),
                    Forms\Components\Select::make('post_type')
                        ->label('Post Type')
                        ->searchable()
                        ->relationship('postType', 'name')
                        ->createOptionForm(Tag::getForm())
                        // this is to make the post type a single select
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                        ->dehydrated(false),
                    Repeater::make('acting')
                        ->relationship('actingPivot')
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
                                        ->options(Tag::query()->whereHas('parents', fn ($query) => $query->where('slug', TagType::ACTING->value))->pluck('name', 'id'))
                                        ->required()
                                        ->createOptionForm(Tag::getForm())
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
}
