<?php

namespace App\Models;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostExtra extends Model
{
    /** @use HasFactory<\Database\Factories\PostExtraFactory> */
    use HasFactory;

    protected $table = 'post_extra';

    // add fillable
    protected $fillable = ['tmdb_id'];

    // add guaded
    protected $guarded = ['id'];

    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the post that owns the post extra.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
