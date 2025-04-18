<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TagParent extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tag_id' => 'integer',
        'parent_id' => 'integer',
    ];

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
