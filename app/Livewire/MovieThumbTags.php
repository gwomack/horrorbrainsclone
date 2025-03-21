<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class MovieThumbTags extends Component
{
    public $search = '';
    public $selectedTags = [];
    public $showDropdown = false;

    // Temporary mock data for tags (replace with database query later)
    protected $allTags = [
        'Haunted House',
        'Supernatural',
        'Family Drama',
        'Psychological',
        'Found Footage',
        'Slasher',
        'Zombie',
        'Gore',
        'Paranormal',
        'Demonic',
        'Cult',
        'Classic',
        'Modern',
        'Indie',
        'Award-Winning'
    ];

    public function render()
    {
        $filteredTags = collect($this->allTags)
            ->filter(function ($tag) {
                return str_contains(strtolower($tag), strtolower($this->search));
            })
            ->values()
            ->toArray();

        return view('livewire.movie-thumb-tags', [
            'filteredTags' => $filteredTags
        ]);
    }

    #[On('tagRemoved')]
    public function handleTagRemoved($tag)
    {
        $this->selectedTags = array_diff($this->selectedTags, [$tag]);
    }

    #[On('tagSelected')]
    public function handleTagSelected($tag)
    {
        if (!in_array($tag, $this->selectedTags)) {
            $this->selectedTags[] = $tag;
        }
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

    #[On('closeDropdown')]
    public function closeDropdown()
    {
        $this->showDropdown = false;
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }
}
