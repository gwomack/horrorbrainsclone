<?php

namespace App\Livewire;

use App\Models\Post\Post;
use App\Models\Tag\SubGenre;
use App\Models\Tag\TrendingHomePage;
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
     * Mount the component.
     */
    public function mount()
    {
        $this->subGenreTags = $this->getSubGenreTags();
        $this->latestReleases = $this->getLatestReleases();
        $this->trendingHomePageTags = $this->getTrendingHomePageTags();
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
        return SubGenre::limit(10)->get();
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
     * Get the trending title.
     */
    public function getTrendingTitle($title)
    {
        $title = explode(' ', $title, 2);

        return "$title[0] <span class='blood-red'>$title[1]</span>";
    }
}
