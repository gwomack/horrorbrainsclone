<?php

namespace App\View\Components\Tag;

use App\Models\Tag\Tag as TagModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tag extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public TagModel $tag,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag.tag');
    }
}
