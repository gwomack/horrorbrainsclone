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
    protected $allTags;

    public function boot()
    {
        $this->allTags = [
            ['id' => 1, 'content' => 'Haunted House', 'type' => 'tag'],
            ['id' => 2, 'content' => 'Supernatural', 'type' => 'tag'],
            ['id' => 3, 'content' => 'Family Drama', 'type' => 'tag'],
            ['id' => 4, 'content' => 'Psychological', 'type' => 'tag'],
            ['id' => 5, 'content' => 'Found Footage', 'type' => 'tag'],
            ['id' => 6, 'content' => 'Slasher', 'type' => 'tag'],
            ['id' => 7, 'content' => 'Zombie', 'type' => 'tag'],
            ['id' => 8, 'content' => 'Gore', 'type' => 'tag'],
            ['id' => 9, 'content' => 'Paranormal', 'type' => 'tag'],
            ['id' => 10, 'content' => 'Demonic', 'type' => 'tag'],
            ['id' => 11, 'content' => 'Cult', 'type' => 'tag'],
            ['id' => 12, 'content' => 'Classic', 'type' => 'tag'],
            ['id' => 13, 'content' => 'Modern', 'type' => 'tag'],
            ['id' => 14, 'content' => 'Indie', 'type' => 'tag'],
            ['id' => 15, 'content' => 'Award-Winning', 'type' => 'tag'],
        ];
    }

    public function render()
    {
        $filteredTags = collect($this->allTags)
            ->filter(function ($tag) {
                return str_contains(strtolower($tag['content']), strtolower($this->search));
            })
            ->toArray();

        return view('livewire.movie-thumb-tags', [
            'filteredTags' => $filteredTags
        ]);
    }

    #[On('tagRemoved')]
    public function handleTagRemoved($id, $content, $type)
    {
        $tagarr = ['id' => $id, 'content' => $content, 'type' => $type];

        $this->selectedTags = collect($this->selectedTags)->filter(function ($arr) use ($tagarr) {
            return $arr != $tagarr;
        })->toArray();
    }

    #[On('tagSelected')]
    public function handleTagSelected($id, $content, $type)
    {
        $tagarr = ['id' => $id, 'content' => $content, 'type' => $type];

        if (!in_array($tagarr, array_column($this->selectedTags, 'id'))) {
            $this->selectedTags[] = ['id' => $id, 'content' => $content, 'type' => $type];
        }
    }

    #[On('toggleTag')]
    public function toggleTag($id, $content, $type)
    {
        if (in_array($id, array_column($this->selectedTags, 'id'))) {
            $this->handleTagRemoved($id, $content, $type);
        } else {
            $this->handleTagSelected($id, $content, $type);
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
