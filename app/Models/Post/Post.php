<?php

namespace App\Models\Post;

use Filament\Forms;
use App\Models\Tag\Tag;
use App\Models\PostExtra;
use App\Models\Tag\Field;
use App\Models\Tag\Acting;
use App\Models\Tag\TagType;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mokhosh\FilamentRating\Components\Rating;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Rupadana\ApiService\Contracts\HasAllowedSorts;
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Rupadana\ApiService\Contracts\HasAllowedIncludes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class Post extends Model implements HasAllowedFields, HasAllowedFilters, HasAllowedIncludes, HasAllowedSorts, HasMedia
{
    use HasComment;
    use HasEmbed;
    use HasFactory;
    use HasRating;
    use HasTag;
    use HasTrending;
    use InteractsWithMedia;
    use SoftDeletes;

    const TRENDING_VIEW = 1;

    const TRENDING_COMMENT = 50;

    const TRENDING_RATING = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_published',
        'published_at',
        'rating',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'release_date' => 'date',
        'rating' => 'decimal:1',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * The attributes that should be set to default.
     *
     * @var array
     */
    protected $attributes = [
        'rating' => 0,
        'is_published' => false,
    ];

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        // Add global scope to order by release date by default
        // self::addGlobalScope('published', function ($query) {
        //     $query->published();
        // });

        /**
         * Set the slug of the post.
         */
        self::creating(function ($post) {
            $post->slug = $post->slug ?? str()->slug($post->title);
        });

        // Save the published at date when the post is published
        self::saving(function ($post) {
            if ($post->isDirty('is_published')) {
                $post->published_at = $post->is_published ? now() : null;
            }
        });

        // Save the tmdb id when the post is created
        self::created(function ($post) {
            if (! App::runningInConsole()) {
                if (request('tmdb_id')) {
                    $post->postExtra()->create([
                        'tmdb_id' => request('tmdb_id'),
                    ]);
                }
            }
        });

        // Clear the cache when the post is saved
        self::saved(function ($post) {
            Cache::forget('movie-search-page.movies');
        });

        // Clear the cache when the post is deleted
        self::deleted(function ($post) {
            Cache::forget('movie-search-page.movies');
        });
    }

    // Which fields can be selected from the database through the query string
    public static function getAllowedFields(): array
    {
        return [
            'id',
            'title',
            'slug',
            'description',
            'is_published',
            'postExtra.tmdb_id',
        ];
    }

    // Which fields can be used to sort the results through the query string
    public static function getAllowedSorts(): array
    {
        return [
            'id',
            'title',
            'slug',
            'description',
            'is_published',
        ];
    }

    // Which fields can be used to filter the results through the query string
    public static function getAllowedFilters(): array
    {
        return [
            'id',
            'title',
            'slug',
            'description',
            'is_published',
        ];
    }

    // Which fields can be used to include in the results through the query string
    public static function getAllowedIncludes(): array
    {
        return [
            'tags',
            'year',
            'genre',
            'subGenre',
            'director',
            'production',
            'writer',
            'distribution',
            'language',
            'country',
            'trendingHomePage',
            'postType',
            'acting',
            'embeds',
            'images',
            'video',
            'trendings',
            'postExtra',
        ];
    }

    /**
     * Increment the trending view.
     */
    public function incrementViewTrending()
    {
        return $this->trendings()->create([
            'rate' => self::TRENDING_VIEW,
        ]);
    }

    /**
     * Scope a query to only include latest posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include draft posts.
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Get the is new attribute.
     */
    protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => isset($attributes['created_at']) && $attributes['created_at'] > now()->subDays(5),
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
     * Get the first year attribute.
     */
    protected function firstYear(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $this->relationLoaded('year') && ! empty($this->relations['year'])
                    ? $this->relations['year']->first()
                    : '';
            }
        );
    }

    /**
     * Get the first genre attribute.
     */
    protected function firstGenre(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $this->relationLoaded('genre') && ! empty($this->relations['genre'])
                    ? $this->relations['genre']->first()
                    : '';
            }
        );
    }

    /**
     * Get the media collections that should be registered.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->registerMediaConversions(function () {
                $this->addMediaConversion('preview')
                    ->withResponsiveImages()
                    ->nonQueued();
                $this->addMediaConversion('thumbnail')
                    ->fit(Fit::Crop, 640, 360)
                    ->nonQueued();
            });
    }

    /**
     * Get the trending posts.
     */
    // convert this function into a local scope
    public function scopeTrendingPosts(Builder $query): void
    {
        // query to get the posts with the highest trending score
        $query->where('posts.is_published', true)
            ->whereHas('trendings', function ($query) {
                $query->where('trending.updated_at', '>', now()->subDays(30));
            })
            ->withSum('trendings', 'rate')
            ->orderBy('trendings_sum_rate', 'desc');
    }

    /**
     * Get the post extra.
     */
    public function postExtra()
    {
        return $this->hasOne(PostExtra::class);
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
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
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
                            // MyRating::make('rating')
                            //     ->label('My Rating'),
                            Rating::make('rating')
                                ->label('Rating')
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
                                ->required()
                                ->columnSpan(2)
                                ->placeholder('https://www.youtube.com/watch?v=...')
                                ->helperText('Enter the video ID'),
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->default(false),
                            Forms\Components\ViewField::make('url')
                                ->label('')
                                ->view('filament.forms.components.youtube-link')
                                ->columnSpanFull()
                                ->dehydrated(false),
                        ]),
                    SpatieMediaLibraryFileUpload::make('images')
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->reorderable()
                        ->responsiveImages()
                        ->collection('images')
                        ->disk('post')
                        ->imagePreviewHeight(150),
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
                    Forms\Components\Select::make('trending_home_page')
                        ->label('Trending Home Page')
                        ->multiple()
                        ->searchable()
                        ->relationship('trendingHomePage', 'name')
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::TRENDING_HOME_PAGE->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('year')
                        ->label('Year')
                        ->searchable()
                        ->relationship('year', 'name')
                        ->preload()
                        ->createOptionForm(Tag::getFormForNoParents())
                        ->createOptionUsing(fn (array $data): int => self::saveTagAndParentAndGetKey($data, TagType::YEAR->value))
                        ->dehydrated(false),
                    Forms\Components\Select::make('post_type')
                        ->label('Post Type')
                        ->searchable()
                        ->relationship('postType', 'name')
                        ->preload()
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
