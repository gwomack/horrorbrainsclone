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
            'movie_type' => 'App\Models\Tag\MovieType',
            // user
            'user' => 'App\Models\User',
        ]);
    }
}
