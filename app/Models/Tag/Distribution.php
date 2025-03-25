<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Distribution extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the distribution.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'distribution');
    }

    /**
     * Get the parents for the distribution.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'distribution');
    }
}
