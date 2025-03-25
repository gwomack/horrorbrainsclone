<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the country.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'country');
    }

    /**
     * Get the parents for the country.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'country');
    }
}
