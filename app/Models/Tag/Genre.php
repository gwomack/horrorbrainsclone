<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Tag
{
    use HasFactory;

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('genre', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::GENRE->value);
            });
        });
    }
}
