<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Director extends Tag
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
        return TagType::DIRECTOR;
    }

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('director', function ($query) {
            $query->distinct()
                ->whereHas('parents', function ($query) {
                    $query->where('slug', TagType::DIRECTOR->value);
                });
        });

        // when a new director tag is created, it should be attached to the director type
        static::created(function ($model) {
            $parent = Tag::where('slug', TagType::DIRECTOR->value)->first();

            if ($parent) {
                $model->parents()->attach($parent->getKey());
            }
        });
    }
}
