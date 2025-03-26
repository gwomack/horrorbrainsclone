<?php

namespace App\Models\Tag;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PostType extends Tag
{
    use HasFactory;

    /**
     * Get the posts for the post type.
     */
    public function posts(): BelongsToMany
    {
        return parent::posts()->wherePivot('type', 'post_type');
    }
}
