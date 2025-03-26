<?php

namespace App\Models\Tag;

use App\Models\Post\PostTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostTagCustomField extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tag_id' => 'integer',
    ];

    /**
     * Get the tag that the custom field belongs to.
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * Get the post tag that the custom field belongs to.
     */
    public function postTag(): BelongsTo
    {
        return $this->belongsTo(PostTag::class);
    }
}
