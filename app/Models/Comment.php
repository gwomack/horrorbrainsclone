<?php

namespace App\Models;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    use SoftDeletes;

    // add guaded
    protected $guarded = ['id'];

    // add hidden
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // add casts
    protected $casts = [
        'approved' => 'boolean',
    ];

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        // increment the trending when the comment is approved
        static::updated(function ($comment) {
            if ($comment->isDirty('approved') && $comment->approved) {
                $comment->post->trendings()->create([
                    'rate' => Post::TRENDING_COMMENT,
                ]);
            }
        });
    }

    /**
     * Get the post that the comment belongs to.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Scope a query to only include approved comments.
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    /**
     * Scope a query to only include pending comments.
     */
    public function scopePending($query)
    {
        return $query->where('approved', false);
    }
}
