<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Embed extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'post_id' => 'integer',
        'type' => EmbedType::class,
    ];

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Set the published_at date when the is_published attribute is changed
        static::saving(function ($model) {
            if ($model->isDirty('is_published')) {
                $model->published_at = $model->is_published ? now() : null;
            }
        });
    }

    /**
     * Scope a query to only include published embeds.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get the post that the video embed belongs to.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
