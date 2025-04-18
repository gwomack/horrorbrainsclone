<?php

namespace App\Models\Post;

use App\Models\Tag\Tag;
use App\Models\Tag\TagType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_tags';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'tag_id' => 'integer',
        'custom' => 'json',
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

    public function acting(): BelongsTo
    {
        return $this->tag()->whereHas('parents', function ($query) {
            $query->where('slug', TagType::ACTING->value);
        });
    }
}
