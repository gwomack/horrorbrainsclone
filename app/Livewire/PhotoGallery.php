<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;

class PhotoGallery extends Component
{
    public $media = [
        [
            'type' => 'image',
            'url' => 'https://cdn11.bigcommerce.com/s-ydriczk/images/stencil/1500x1500/products/90301/98769/the-creator-original-movie-poster-one-sheet-final-style-buy-now-at-starstills__81077.1697644483.jpg?c=2'
        ],
        [
            'type' => 'youtube',
            'id' => 'VWqJifMMgZE'
        ],
    ];

    /**
     * Render the component
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.photo-gallery');
    }
}
