<?php

namespace App\Models\Tag;

use Filament\Forms;
use App\Models\Movie;
use App\Models\MovieTag;
use App\Models\Tag\TagCustomField;
use App\Models\Tag\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
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
     * Get the movies for the tag.
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)
            ->using(MovieTag::class)
            ->as('movie_tag')
            ->withPivot('id', 'movie_id', 'tag_id', 'type')
            ->withTimestamps();
    }

    /**
     * Get the form for the tag.
     */
    public static function getForm(): array
    {
        return [
            Grid::make('Name')
                ->columns(2)
                ->schema([
                    Section::make('Tag')
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Tag')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Textarea::make('description')
                                ->label('Description'),
                        ]),
                    Forms\Components\Repeater::make('tagCustomFields')
                        ->label('Custom Fields')
                        ->relationship('tagCustomFields')
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\Select::make('field')
                                ->label('Field')
                                ->enum(Field::class)
                                ->options(Field::class)
                                ->default(Field::As)
                                    ->required()
                                    ->inlineLabel(),
                                Forms\Components\TextInput::make('value')
                                    ->label('Value')
                                    ->required()
                                    ->inlineLabel(),
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
                            ]),
                    ]),
        ];
    }

    /**
     * Get the custom fields for the tag.
     */
    public function tagCustomFields(): HasMany
    {
        return $this->hasMany(TagCustomField::class);
    }
}
