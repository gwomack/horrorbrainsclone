<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Tag
{
    use HasFactory;

    /**
     * The attributes that should be fillable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

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

        // when a new acting tag is created, it should be attached to the acting type
        static::created(function ($model) {
            $parent = Tag::where('slug', TagType::LANGUAGE->value)->first();

            if ($parent) {
                $model->parents()->attach($parent->getKey());
            }
        });
    }
}
