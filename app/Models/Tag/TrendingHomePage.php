<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrendingHomePage extends Tag
{
    use HasFactory;

    protected $table = 'tags';

    public static function boot()
    {
        parent::boot();

        // this is to make the acting tag a single select
        self::addGlobalScope('trending_home_page', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::TRENDING_HOME_PAGE->value);
            });
        });
    }

    /**
     * Get the search url attribute.
     */
    protected function searchUrl(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => route('movie.search', ['tag' => [$attributes['id']]]),
        );
    }
}
