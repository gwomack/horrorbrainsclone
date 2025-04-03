<?php

namespace App\View\Components;

use App\Models\Post\Post;
use App\Models\SimilarPosts as SimilarPostsModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimilarPosts extends Component
{
    protected SimilarPostsModel $similarPosts;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected Post $post
    ) {
        $this->similarPosts = new SimilarPostsModel($this->post);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.similar-posts', [
            'similarPosts' => $this->similarPosts->query()->get(),
        ]);
    }
}
