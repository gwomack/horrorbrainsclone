<?php

namespace App\View\Components\Tag;

use Closure;
use Illuminate\Contracts\View\View;

class HomeTag extends Tag
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag.home-tag');
    }
}
