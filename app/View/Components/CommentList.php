<?php

namespace App\View\Components;

use App\Models\Post\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Livewire\WithPagination;

class CommentList extends Component
{
    use WithPagination;

    /**
     * Create a new component instance.
     */
    public function __construct(public Post $post)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment-list', [
            'comments' => $this->post->comments()->approved()->paginate(10),
        ]);
    }
}
