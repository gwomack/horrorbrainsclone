<?php

namespace App\View\Components\Movie;

use App\Models\Post\Post;
use Illuminate\View\Component;

class MovieBlock extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Post $movie
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.movie.movie-block');
    }
}
