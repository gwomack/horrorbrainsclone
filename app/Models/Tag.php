<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_tags')
            ->using(MovieTag::class)
            ->as('movie_tag')
            ->withPivot('id', 'movie_id', 'tag_id', 'type')
            ->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->using(TagParent::class)
            ->as('tag_parent')
            ->withPivot('id', 'tag_id', 'parent_id')
            ->withTimestamps();
    }
}
