<?php

namespace App\Models\Tag;

use Filament\Forms;
use App\Models\Post\Post;
use App\Models\Post\PostTag;
use Database\Factories\Tag\TagFactory;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Rupadana\ApiService\Contracts\HasAllowedSorts;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rupadana\ApiService\Contracts\HasAllowedIncludes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tag extends Model implements HasType, HasAllowedFields, HasAllowedFilters, HasAllowedIncludes, HasAllowedSorts
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The factory for the model.
     */
    protected static function newFactory()
    {
        return TagFactory::new();
    }

    /**
     * The table associated with the model.
     */
    protected $table = 'tags';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The attributes that should be appended to the model.
     */
    protected $appends = [
        'type',
    ];

    /**
     * The attributes that should be fillable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        /**
         * Set the slug of the tag.
         */
        static::creating(function ($tag) {
            $tag->slug = $tag->slug ?? str()->slug($tag->name);
        });
    }

    // Which fields can be selected from the database through the query string
    public static function getAllowedFields(): array
    {
        return [
            'id',
            'name',
            'slug',
            'description',
            'posts_count',
            'parents_count',
            'created_at',
            'updated_at',
        ];
    }

    // Which fields can be used to sort the results through the query string
    public static function getAllowedSorts(): array
    {
        return [
            'id',
            'name',
            'slug',
            'description',
            'posts_count',
            'parents_count',
            'created_at',
            'updated_at',
        ];
    }

    // Which fields can be used to filter the results through the query string
    public static function getAllowedFilters(): array
    {
        return [
            'id',
            'name',
            'slug',
            'description',
            'posts_count',
            'parents_count',
            'created_at',
            'updated_at',
            'parents.name',
            'parents.slug',
            'parents.description',
            'parents.posts_count',
            'parents.parents_count',
            'parents.created_at',
            'parents.updated_at',
        ];
    }

    // Which fields can be used to include in the results through the query string
    public static function getAllowedIncludes(): array
    {
        return [
            'posts',
            'parents',
            'posts_count',
            'parents_count',
        ];
    }


    /**
     * Get the type of the tag.
     */
    public function getType(): TagType
    {
        return TagType::TAG;
    }

    /**
     * Get the type of the tag.
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $this->getType();
            },
        );
    }

    /**
     * Get the posts for the tag.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id')
            ->using(PostTag::class);
    }

    /**
     * Get the parent tags for the tag.
     */
    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'tag_parents', 'tag_id', 'parent_id')
            ->using(TagParent::class);
    }

    /**
     * Get the post tags for the tag.
     */
    public function postTag(): HasMany
    {
        return $this->hasMany(PostTag::class);
    }

    /**
     * Get the form for the tag without parents.
     */
    public static function getFormForNoParents(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Tag')
                ->required()
                ->maxLength(255)
                ->live(debounce: 1000)
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('slug', str()->slug($state));
                }),
            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => str()->slug($state)),
            Forms\Components\Textarea::make('description')
                ->label('Description'),
        ];
    }

    /**
     * Get the form for the tag.
     */
    public static function getForm(): array
    {
        return [
            Section::make('Tag')
                ->columns(2)
                ->schema([
                    ...self::getFormForNoParents(),
                    Forms\Components\Select::make('parent_id')
                        ->label('Parent')
                        ->relationship('parents', 'name', function ($query) {
                            $query->whereDoesntHave('parents');
                        })
                        ->multiple()
                        ->searchable(),
                ]),
        ];
    }
}
