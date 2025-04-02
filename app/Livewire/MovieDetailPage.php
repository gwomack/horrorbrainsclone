<?php

namespace App\Livewire;

use App\Models\Post\Post;
use Livewire\Component;

class MovieDetailPage extends Component
{
    /**
     * The post.
     */
    public $post;

    /**
     * The post id.
     */
    public $slug;

    /**
     * Mount the component.
     */
    public function mount()
    {
        $this->slug = request()->route('post');

        if (! $this->slug) {
            return redirect()->route('home');
        }

        $this->post = Post::with(['embeds' => function ($query) {
            $query->published();
        }])->with('media', 'year', 'genre', 'acting', 'production', 'distribution', 'country', 'language', 'subGenre')
            ->where('slug', $this->slug)->first();

        if (! $this->post) {
            return redirect()->route('home');
        }
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.movie-detail.movie-detail-page');
    }
}
