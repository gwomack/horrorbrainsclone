<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MovieTag extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movie_tags';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'movie_id' => 'integer',
        'tag_id' => 'integer',
    ];

    /**
     * Get the movie that the tag belongs to.
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Get the tag that the movie tag belongs to.
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
