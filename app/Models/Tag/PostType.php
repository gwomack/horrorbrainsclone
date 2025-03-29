<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostType extends Tag
{
    use HasFactory;

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('post_type', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::POST_TYPE->value);
            });
        });
    }
}
