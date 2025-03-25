<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Language extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the language.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'language');
    }

    /**
     * Get the parents for the language.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'language');
    }
}
