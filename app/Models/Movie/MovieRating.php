<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieRating extends Model
{
    use HasFactory;

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        // If the user is authenticated, set the user_id to the current user's id
        static::saving(function ($model) {
            if (auth()->check()) {
                $model->user_id = auth()->user()->id;
            }
        });

        // Update the movie rating when a rating is saved
        static::saved(function ($model) {
            $model->movie()->update(['rating' => $model->getAvgRating()]);
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'movie_id' => 'integer',
        'rating' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the average rating for the movie.
     */
    public function getAvgRating()
    {
        return $this->where('movie_id', $this->movie_id)->avg('rating') ?? 0;
    }

    /**
     * Get the movie that the rating belongs to.
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Get the user that the rating belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
