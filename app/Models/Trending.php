<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Trending extends Model
{
    /** @use HasFactory<\Database\Factories\TrendingFactory> */
    use HasFactory;

    protected $table = 'trending';

    // add fillable
    protected $fillable = ['rate', 'item_id', 'item_type'];

    // add guaded
    protected $guarded = ['id'];

    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    // add attributes
    protected $attributes = [
        'rate' => 0,
    ];

    // add casts
    protected $casts = [
        'rate' => 'integer',
    ];

    /**
     * Get the item that the trending belongs to.
     */
    public function item(): MorphTo
    {
        return $this->morphTo();
    }
}
