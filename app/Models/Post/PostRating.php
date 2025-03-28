<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostRating extends Model
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

        // Update the post rating when a rating is saved
        static::saved(function ($model) {
            $model->post()->update(['rating' => $model->getAvgRating()]);
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'rating' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the average rating for the post.
     */
    public function getAvgRating()
    {
        return $this->where('post_id', $this->post_id)->avg('rating') ?? 0;
    }

    /**
     * Get the post that the rating belongs to.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user that the rating belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
