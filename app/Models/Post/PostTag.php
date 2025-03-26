<?php

namespace App\Models\Post;

use App\Models\Tag\Tag;
use App\Models\Post\Post;
use App\Models\PostTagCustomField;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostTag extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_tags';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'tag_id' => 'integer',
    ];

    /**
     * Get the post that the tag belongs to.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the tag that the post tag belongs to.
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * Get the custom fields for the post tag.
     */
    public function postTagCustomFields(): HasMany
    {
        return $this->hasMany(PostTagCustomField::class);
    }
}
