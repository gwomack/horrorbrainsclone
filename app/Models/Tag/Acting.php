<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Acting extends Tag
{
    use HasFactory;

    /**
     * Get the posts for the acting.
     */
    public function posts(): BelongsToMany
    {
        return parent::posts()->wherePivot('type', TagType::ACTING)
            ->withPivotValue('type', TagType::ACTING);
    }
}
