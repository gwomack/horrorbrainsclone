<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Production extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the production.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'production');
    }

    /**
     * Get the parents for the production.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'production');
    }
}
