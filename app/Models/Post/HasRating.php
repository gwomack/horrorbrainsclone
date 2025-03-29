<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRating
{
    /**
     * Get the post ratings for the post.
     */
    public function postRatings(): HasMany
    {
        return $this->hasMany(PostRating::class);
    }
}
