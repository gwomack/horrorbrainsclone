<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Tag
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
        return TagType::MOVIE;
    }

    public static function boot()
    {
        parent::boot();

        // this is to make the movie tag a single select
        static::addGlobalScope('movie', function ($query) {
            $query->distinct()->whereHas('parents', function ($query) {
                $query->where('slug', TagType::MOVIE->value);
            });
        });

        // when a new movie tag is created, it should be attached to the movie type
        static::created(function ($model) {
            $parent = Tag::where('slug', TagType::MOVIE->value)->first();

            if ($parent) {
                $model->parents()->attach($parent->getKey());
            }
        });
    }
}
