<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubGenre extends Tag
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
        return TagType::SUB_GENRE;
    }

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

        // when a new acting tag is created, it should be attached to the acting type
        static::created(function ($model) {
            $parent = Tag::where('slug', TagType::SUB_GENRE->value)->first();

            if ($parent) {
                $model->parents()->attach($parent->getKey());
            }
        });
    }
}
