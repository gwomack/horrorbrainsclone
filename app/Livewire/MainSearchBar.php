<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Log;

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
            $this->selectedTags[] = $this->input;
        }

        $this->reset('input');
    }

    #[On('tagSelected')]
    public function handleTagSelected($tag)
    {
        if (!in_array($tag, $this->selectedTags)) {
            $this->selectedTags[] = $tag;
        }
    }

    #[On('tagRemoved')]
    public function handleTagRemoved($tag)
    {
        $this->selectedTags = array_diff($this->selectedTags, [$tag]);
    }

    #[On('toggleTag')]
    public function toggleTag($tag)
    {
        if (in_array($tag, $this->selectedTags)) {
            $this->dispatch('tagRemoved', tag: $tag);
        } else {
            $this->dispatch('tagSelected', tag: $tag);
        }
    }

    public function render()
    {
        return view('livewire.main-search-bar');
    }
}
