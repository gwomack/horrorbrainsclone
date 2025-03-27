<?php

namespace App\Models\Tag;

use App\Models\Post\Post;
use App\Models\Post\PostTag;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tag extends Model
{
    use HasFactory;

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
            ->using(PostTag::class)
            ->as('post_tag')
            ->withPivot('id', 'post_id', 'tag_id', 'type')
            ->withTimestamps();
    }

    /**
     * Get the custom fields for the tag.
     */
    public function postTagCustomFields(): HasManyThrough
    {
        return $this->hasManyThrough(PostTagCustomField::class, PostTag::class);
    }

    /**
     * Get the post tags for the tag.
     */
    public function postTag(): HasMany
    {
        return $this->hasMany(PostTag::class);
    }

    /**
     * Get the form for the tag.
     */
    public static function getForm(): array
    {
        return [
            Section::make('Tag')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Tag')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->label('Description'),
                ]),
        ];
    }

    /**
     * Get the form for the post tag.
     */
    public static function getCustomFieldsForm(): array
    {
        return [
            Forms\Components\Select::make('field')
                ->label('Field')
                ->enum(Field::class)
                ->options(Field::class)
                ->default(Field::As)
                ->required(),
            Forms\Components\TextInput::make('value')
                ->label('Value')
                ->required(),
            // Forms\Components\RichEditor::make('value')
            //     ->label('Value')
            //     ->required()
            //     ->toolbarButtons([
            //         // 'attachFiles',
            //         // 'blockquote',
            //         // 'bold',
            //         // 'bulletList',
            //         // 'codeBlock',
            //         // 'h2',
            //         // 'h3',
            //         'italic',
            //         // 'link',
            //         // 'orderedList',
            //         'redo',
            //         // 'strike',
            //         // 'underline',
            //         'undo',
            //     ])->inlineLabel()
            //     ->extraInputAttributes(['class' => 'smaller-editor']),
        ];
    }
}
