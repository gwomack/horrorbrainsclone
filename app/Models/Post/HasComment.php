<?php

namespace App\Models\Post;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasComment
{
    /**
     * Get the embeds for the post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
