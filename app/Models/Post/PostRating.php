<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class PostRating extends Model
{
    use HasFactory;

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->post->trendings()->create([
                'rate' => $model->rating * Post::TRENDING_RATING,
            ]);
        });

        // If the user is authenticated, set the user_id to the current user's id
        self::saving(function ($model) {
            if (Auth::check()) {
                $model->user_id = $model->user_id ?: Auth::id();
            }

            $model->public_user = $model->public_user ?? getPublicUserChecksum();
        });

        // Update the post rating when a rating is saved
        self::saved(function ($model) {
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
        'rating' => 'float',
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
