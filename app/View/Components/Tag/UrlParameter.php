<?php

namespace App\View\Components\Tag;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UrlParameter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $urlParameter,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag.url-parameter');
    }
}
