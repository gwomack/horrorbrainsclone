<?php

namespace App\Livewire;

use App\Models\Post\Post;
use Livewire\Component;

class PhotoGallery extends Component
{
    public $media = [
        // [
        //     'type' => 'image',
        //     'url' => 'https://cdn11.bigcommerce.com/s-ydriczk/images/stencil/1500x1500/products/90301/98769/the-creator-original-movie-poster-one-sheet-final-style-buy-now-at-starstills__81077.1697644483.jpg?c=2',
        // ],
        // [
        //     'type' => 'youtube',
        //     'id' => 'VWqJifMMgZE',
        // ],
    ];

    /**
     * The post.
     */
    public $post;

    /**
     * Mount the component.
     */
    public function mount(Post $post)
    {
        $this->post = $post;

        $this->prepareMediaFromPost();
    }

    /**
     * Prepare the media from the post.
     */
    protected function prepareMediaFromPost()
    {
        foreach ($this->post->media as $media) {
            $this->media[] = [
                'type' => isImage($media->mime_type) ? 'image' : '',
                'url' => $media->getUrl(),
            ];
        }

        foreach ($this->post->embeds as $embed) {
            $this->media[] = [
                'type' => $embed->type->value,
                'id' => $embed->embed,
            ];
        }
    }

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
