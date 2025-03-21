<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class MainSearchBar extends Component
{
    public $input = '';
    public $selectedTags = [];

    #[On('inputSelected')]
    public function handleInput()
    {
        $this->validate([
            'input' => 'required|string|max:20',
        ]);

        $this->input = trim($this->input);

        if (!in_array($this->input, $this->selectedTags)) {
            $this->selectedTags[] = ['id' => 0, 'content' => $this->input, 'type' => 'input'];
        }

        $this->reset('input');
    }

    #[On('tagSelected')]
    public function handleTagSelected($id, $content, $type)
    {
        $tagarr = ['id' => $id, 'content' => $content, 'type' => $type];

        if (!in_array($tagarr, $this->selectedTags)) {
            $this->selectedTags[] = ['id' => $id, 'content' => $content, 'type' => $type];
        }
    }

    #[On('tagRemoved')]
    public function handleTagRemoved($id, $content, $type)
    {
        $this->selectedTags = array_filter($this->selectedTags, function($tag) use ($id, $content, $type) {
            return !($tag['id'] === $id && $tag['content'] === $content && $tag['type'] === $type);
        });
    }

    #[On('toggleTag')]
    public function toggleTag($id, $content, $type)
    {
        $tagarr = ['id' => $id, 'content' => $content, 'type' => $type];

        if (in_array($tagarr, $this->selectedTags)) {
            $this->handleTagRemoved($id, $content, $type);
        } else {
            $this->handleTagSelected($id, $content, $type);
        }
    }

    public function render()
    {
        return view('livewire.main-search-bar');
    }
}
