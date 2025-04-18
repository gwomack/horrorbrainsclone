<?php

namespace App\Livewire;

use App\Models\Post\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CommentPolicyPage extends Component
{
    #[Computed]
    public function randomMovies()
    {
        $key = 'random-movies';

        return cache()->remember($key, 360, function () {
            return Post::with('year', 'genre')->inRandomOrder()->limit(6)->get();
        });
    }

    public function render()
    {
        return view('livewire.comment-policy-page', [
            'randomMovies' => $this->randomMovies,
        ]);
    }
}
