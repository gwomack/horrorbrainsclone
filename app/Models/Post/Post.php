<?php

namespace App\Models\Post;

use Filament\Forms;
use App\Models\Embeds;
use App\Models\Tag\Tag;
use App\Models\Post\PostTag;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Mokhosh\FilamentRating\Components\Rating;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        return $this->hasMany(Embeds::class);
    }

    /**
     * Get the tags for the post.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags')
            ->using(PostTag::class)
            ->as('post_tag')
            ->withPivot('id', 'post_id', 'tag_id', 'type')
            ->withTimestamps();
    }

    /**
     * Get the directors for the post.
     */
    public function director(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'director')
            ->withPivotValue('type', 'director');
    }

    /**
     * Get the writers for the post.
     */
    public function writer(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'writer')
            ->withPivotValue('type', 'writer');
    }

    /**
     * Get the production for the post.
     */
    public function production(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'production')
            ->withPivotValue('type', 'production');
    }

    /**
     * Get the actors for the post.
     */
    public function acting(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'acting')
            ->withPivotValue('type', 'acting');
    }

    /**
     * Get the countries for the post.
     */
    public function country(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'country')
            ->withPivotValue('type', 'country');
    }

    /**
     * Get the languages for the post.
     */
    public function language(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'language')
            ->withPivotValue('type', 'language');
    }

    /**
     * Get the years for the post.
     */
    public function year(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'year')
            ->withPivotValue('type', 'year');
    }

    /**
     * Get the sub genres for the post.
     */
    public function subGenre(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'sub_genre')
            ->withPivotValue('type', 'sub_genre');
    }

    /**
     * Get the genres for the post.
     */
    public function genre(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'genre')
            ->withPivotValue('type', 'genre');
    }

    /**
     * Get the distributors for the post.
     */
    public function distribution(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'distribution')
            ->withPivotValue('type', 'distribution');
    }

    /**
     * Get the post ratings for the post.
     */
    public function postRatings(): HasMany
    {
        return $this->hasMany(PostRating::class);
    }

    /**
     * Get the post types for the post.
     */
    public function PostType(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'post_type')
            ->withPivotValue('type', 'post_type');
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
                    Forms\Components\Select::make('acting')
                        ->label('Acting')
                        ->columnSpan(2)
                        ->multiple()
                        ->searchable()
                        ->relationship('acting', 'name')
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
                        ->dehydrated(false)
                        ->multiple(false),
                    Forms\Components\Select::make('post_type')
                        ->label('Post Type')
                        ->searchable()
                        ->relationship('postType', 'name')
                        ->createOptionForm(Tag::getForm())
                        // this is to make the post type a single select
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                        ->dehydrated(false)
                        ->multiple(false),
                ]),
        ];
    }
}
