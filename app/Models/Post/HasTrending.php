<?php

namespace App\Models\Post;

use App\Models\Trending;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTrending
{
    /**
     * Get the post trendings.
     */
    public function trendings(): MorphMany
    {
        return $this->morphMany(Trending::class, 'trendable', 'trendable_type', 'trendable_id');
    }
}
