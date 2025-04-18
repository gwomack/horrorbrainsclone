<?php

namespace App\Livewire;

use App\Models\Post\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

class MovieDetailPage extends Component
{
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

        if (! $this->post) {
            abort(404);
        }

        // Increment the trending view
        $this->post->incrementViewTrending();
    }

    /**
     * Get the post.
     */
    #[Computed]
    public function post()
    {
        $post = Post::published()->with(['embeds' => function ($query) {
            $query->published();
        }])->with(
            'media', 'year', 'genre', 'acting', 'production', 'distribution',
            'country', 'language', 'subGenre', 'director', 'writer',
        )->where('slug', $this->slug);
        // debug space
        return $post->first();
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.movie-detail.movie-detail-page', [
            'post' => $this->post,
        ]);
    }
}
