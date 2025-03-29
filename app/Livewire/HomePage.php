<?php

namespace App\Livewire;

use App\Models\Post\Post;
use App\Models\Tag\SubGenre;
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
     * Mount the component.
     */
    public function mount()
    {
        $this->subGenreTags = $this->getSubGenreTags();
        $this->latestReleases = $this->getLatestReleases();
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
        return SubGenre::limit(10)->get()->map(function ($tag) {
            $tag->type = UrlParamType::TAG;

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
}
