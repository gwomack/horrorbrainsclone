<?php

namespace App\Models\Tag;

use App\Models\Post\Post;
use App\Models\Post\PostTag;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

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
     * Get the posts for the tag.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)
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
