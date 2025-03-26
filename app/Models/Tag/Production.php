<?php

namespace App\Models\Tag;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Production extends Tag
{
    use HasFactory;

    /**
     * Get the posts for the production.
     */
    public function posts(): BelongsToMany
    {
        return parent::posts()->wherePivot('type', 'production');
    }
}
