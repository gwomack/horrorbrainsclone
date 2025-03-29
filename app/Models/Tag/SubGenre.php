<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubGenre extends Tag
{
    use HasFactory;

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        // filter out the sub genre tags
        self::addGlobalScope('sub_genre', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::SUB_GENRE->value);
            });
        });
    }
}
