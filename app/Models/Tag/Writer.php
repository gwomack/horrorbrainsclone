<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Writer extends Tag
{
    use HasFactory;

    /**
     * Get the movies for the writer.
     */
    public function movies(): BelongsToMany
    {
        return parent::movies()->wherePivot('type', 'writer');
    }

    /**
     * Get the parents for the writer.
     */
    public function parents(): BelongsToMany
    {
        return parent::parents()->wherePivot('type', 'writer');
    }
}
