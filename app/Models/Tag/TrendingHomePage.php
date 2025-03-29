<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrendingHomePage extends Tag
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        // this is to make the acting tag a single select
        static::addGlobalScope('trending_home_page', function ($query) {
            $query->whereHas('parents', function ($query) {
                $query->where('slug', TagType::TRENDING_HOME_PAGE->value);
            });
        });
    }
}
