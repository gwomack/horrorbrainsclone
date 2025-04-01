<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class RelationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Morph map for tags
        Relation::enforceMorphMap([
            // tag types
            'tag' => 'App\Models\Tag\Tag',
            'genre' => 'App\Models\Tag\Genre',
            'director' => 'App\Models\Tag\Director',
            'acting' => 'App\Models\Tag\Acting',
            'writer' => 'App\Models\Tag\Writer',
            'production' => 'App\Models\Tag\Production',
            'distribution' => 'App\Models\Tag\Distribution',
            'country' => 'App\Models\Tag\Country',
            'language' => 'App\Models\Tag\Language',
            'year' => 'App\Models\Tag\Year',
            'sub_genre' => 'App\Models\Tag\SubGenre',
            'post_type' => 'App\Models\Tag\PostType',
            'trending_home_page' => 'App\Models\Tag\TrendingHomePage',
            // other models
            'user' => 'App\Models\User',
            'post' => 'App\Models\Post\Post',
        ]);
    }
}
