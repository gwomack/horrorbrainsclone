<?php

use App\Models\Post\Post;
use App\Models\Trending;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;

// Clean up trending records older than 30 days
Artisan::command('trending:clean', function () {
    Trending::where('updated_at', '<', now()->subDays(30))->delete();
})->purpose('Clean up trending records older than 30 days')->daily();

// Generate the sitemap
Artisan::command('sitemap:generate', function () {
    $sitemap = SitemapGenerator::create(config('app.url'))
        ->getSitemap();

    // Add static pages
    $sitemap->add(URL::to('/'), now(), '1.0', 'daily')
        ->add(URL::route('movie.search'), now(), '0.8', 'weekly')
        ->add(URL::route('aboutus'), now(), '0.5', 'monthly')
        ->add(URL::route('privacypolicy'), now(), '0.3', 'monthly')
        ->add(URL::route('termsconditions'), now(), '0.3', 'monthly')
        ->add(URL::route('commentpolicy'), now(), '0.3', 'monthly');

    // Add movie detail pages
    $posts = Post::published()->latest()->get();
    foreach ($posts as $post) {
        $sitemap->add(URL::route('movie.details', $post->slug), $post->updated_at, '0.9', 'weekly');
    }

    $sitemap->writeToFile('public/sitemap.xml');

})->purpose('Generate the sitemap')->daily();

// Prune telescope records older than 30 days
Schedule::command('telescope:prune --days=30')->daily();
