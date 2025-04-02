<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Writer extends Tag
{
    use HasFactory;

    /**
     * Get the type of the tag.
     */
    public function getType(): TagType
    {
        return TagType::WRITER;
    }

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('writer', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::WRITER->value);
            });
        });
    }
}
