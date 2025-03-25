<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubGenre extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the genre.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'sub_genre');
    }

    /**
     * Get the parents for the genre.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'sub_genre');
    }
}
