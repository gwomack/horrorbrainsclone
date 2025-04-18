<?php

namespace App\Livewire;

use App\Models\Post\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AboutUsPage extends Component
{
    #[Computed]
    public function randomMovies()
    {
        $key = 'random-movies';

        return cache()->remember($key, 360, function () {
            return Post::published()->with('year', 'genre')->inRandomOrder()->limit(3)->get();
        });
    }

    public function render()
    {
        return view('livewire.about-us-page', [
            'randomMovies' => $this->randomMovies,
        ]);
    }
}
