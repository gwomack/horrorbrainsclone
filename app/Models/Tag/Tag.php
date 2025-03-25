<?php

namespace App\Models\Tag;

use App\Models\Movie;
use App\Models\MovieTag;
use Filament\Forms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->columnSpanFull(),
        ];
    }
}
