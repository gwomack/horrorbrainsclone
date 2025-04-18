<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEmbed
{
    /**
     * Get the embeds for the post.
     */
    public function embeds(): HasMany
    {
        return $this->hasMany(Embed::class);
    }
}
