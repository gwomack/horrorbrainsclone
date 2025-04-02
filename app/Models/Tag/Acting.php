<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acting extends Tag
{
    use HasFactory;

    /**
     * Get the type of the tag.
     */
    public function getType(): TagType
    {
        return TagType::ACTING;
    }

    public static function boot()
    {
        parent::boot();

        // this is to make the acting tag a single select
        static::addGlobalScope('acting', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::ACTING->value);
            });
        });
    }
}
