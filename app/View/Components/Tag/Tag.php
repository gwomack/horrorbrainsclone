<?php

namespace App\View\Components\Tag;

use App\Livewire\UrlParamType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tag extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $content,
        public UrlParamType $type
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag.tag');
    }
}
