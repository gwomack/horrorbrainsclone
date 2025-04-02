<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distribution extends Tag
{
    use HasFactory;

    /**
     * Get the type of the tag.
     */
    public function getType(): TagType
    {
        return TagType::DISTRIBUTION;
    }

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('distribution', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::DISTRIBUTION->value);
            });
        });
    }
}
