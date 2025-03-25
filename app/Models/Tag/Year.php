<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Year extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the year.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'year');
    }

    /**
     * Get the parents for the year.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'year');
    }
}
