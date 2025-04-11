<?php

namespace App\Models;

use App\Models\Post\Post;

/**
 * Similar Posts Model
 */
class SimilarPosts
{
    public function __construct(
        public Post $post,
    ) {}

    /**
     * Query the similar posts.
     */
    public function query()
    {
        $similarPosts = Post::published()->whereNot('id', $this->post->id)->whereHas('tags', function ($query) {
            $query->whereIn('tags.id', $this->post->tags->pluck('id'));
        })->with('year', 'genre')->inRandomOrder()->limit(8);

        return $similarPosts;
    }
}
