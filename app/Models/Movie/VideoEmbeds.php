<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoEmbeds extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'movie_id' => 'integer',
        'type' => VideoEmbedType::class,
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
     * Get the movie that the video embed belongs to.
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
