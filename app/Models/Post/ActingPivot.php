<?php

namespace App\Models\Post;

use App\Models\Tag\TagType;

class ActingPivot extends PostTag
{
    /**
     * Create a new model instance.
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes['type'] = TagType::ACTING->value;
    }

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        static::addGlobalScope(TagType::ACTING->value, function ($builder) {
            $builder->where('type', TagType::ACTING->value);
        });
    }
}
