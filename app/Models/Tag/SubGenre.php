<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubGenre extends Tag
{
    use HasFactory;

    /**
     * Get the posts for the sub genre.
     */
    public function posts(): BelongsToMany
    {
        return parent::posts()->wherePivot('type', 'sub_genre');
    }
}
