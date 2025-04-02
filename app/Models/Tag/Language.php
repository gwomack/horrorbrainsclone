<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Tag
{
    use HasFactory;

    /**
     * Get the type of the tag.
     */
    public function getType(): TagType
    {
        return TagType::LANGUAGE;
    }

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('language', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::LANGUAGE->value);
            });
        });
    }
}
