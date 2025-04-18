<?php

namespace App\Livewire;

use App\Models\Post\Post;
use App\Models\Tag\SubGenre;
use App\Models\Tag\TrendingHomePage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;

class HomePage extends Component
{
    /**
     * The sub genre tags.
     */
    public $subGenreTags;

    /**
     * The latest releases.
     */
    public $latestReleases;

    /**
     * The trending home page tags.
     */
    public $trendingHomePageTags;

    /**
     * The random tags.
     */
    public $randomTags;

    /**
     * Mount the component.
     */
    public function mount()
    {
        $this->subGenreTags = $this->getSubGenreTags();
        $this->latestReleases = $this->getLatestReleases();
        $this->trendingHomePageTags = $this->getTrendingHomePageTags();
        $this->randomTags = $this->getRandomTags();
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.page.home-page');
    }

    /**
     * Get the sub genre tags.
     */
    protected function getSubGenreTags()
    {
        return Cache::remember('sub-genre-tags', 3600, function () {
            return SubGenre::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->orderBy('name', 'asc')
                ->limit(15)->get();
        });
    }

    /**
     * Get the trending home page tags.
     */
    protected function getTrendingHomePageTags()
    {
        return TrendingHomePage::with('posts')
            ->with(['posts' => function ($query) {
                $query->with(['year', 'genre'])->published()->orderBy('release_date', 'desc')->limit(8);
            }])
            ->whereHas('posts', function ($query) {
                $query->published();
            }, '>', 3)
            ->limit(3)
            ->get()
            ->map(function ($tag) {
                $tag->posts->transform(function ($post) {
                    $post->description = Str::limit($post->description, 100);
                    $post->title = Str::limit($post->title, 50);

                    return $post;
                });

                return $tag;
            });
    }

    /**
     * Get the latest releases.
     */
    protected function getLatestReleases()
    {
        return Post::published()->latest('release_date')
            ->with(['year', 'genre'])
            ->limit(3)
            ->get()
            ->map(function ($post) {
                $post->year = optional($post->year->first())->name;
                $post->genre = optional($post->genre->first())->name;
                $post->description = Str::limit($post->description, 100);
                $post->title = Str::limit($post->title, 50);

                return $post;
            });
    }

    /**
     * Get random tags.
     */
    protected function getRandomTags()
    {
        $key = 'random-tags';
        $seconds = 3600; // 1 hour...

        return Cache::remember($key, $seconds, function () {
            return SubGenre::inRandomOrder()
                ->withCount(['posts' => function ($query) {
                    $query->published();
                }])
                ->limit(12)
                ->get();
        });

    }

    /**
     * Get the trending title.
     */
    public function getTrendingTitle($title)
    {
        $title = explode(' ', $title, 2);

        return "$title[0] <span class='blood-red'>$title[1]</span>";
    }
}
