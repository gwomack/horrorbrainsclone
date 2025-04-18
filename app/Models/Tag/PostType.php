<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostType extends Tag
{
    use HasFactory;

    /**
     * Get the type of the tag.
     */
    public function getType(): TagType
    {
        return TagType::POST_TYPE;
    }

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

        // when a new acting tag is created, it should be attached to the acting type
        static::created(function ($model) {
            $parent = Tag::where('slug', TagType::POST_TYPE->value)->first();

            if ($parent) {
                $model->parents()->attach($parent->getKey());
            }
        });
    }
}
