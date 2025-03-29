<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Tag
{
    use HasFactory;

    /**
     * Get the posts for the country.
     */
    public function posts(): BelongsToMany
    {
        return parent::posts()->whereHas('parents', function ($query) {
            $query->where('name', 'Country');
        });
    }
}
