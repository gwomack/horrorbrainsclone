<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Director extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the director.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'director');
    }

    /**
     * Get the parents for the director.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'director');
    }
}
