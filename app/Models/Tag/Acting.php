<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Acting extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the acting.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'acting');
    }

    /**
     * Get the parents for the acting.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'acting');
    }
}
