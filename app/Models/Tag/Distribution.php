<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Distribution extends Tag
{
    use HasFactory;

    /**
     * Get the posts for the distribution.
     */
    public function posts(): BelongsToMany
    {
        return parent::posts()->whereHas('parents', function ($query) {
            $query->where('name', 'Distribution');
        });
    }
}
