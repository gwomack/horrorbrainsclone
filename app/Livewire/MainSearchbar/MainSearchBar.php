<?php

namespace App\Livewire\MainSearchBar;

use App\Models\Tag\TagType;
use Livewire\Attributes\On;
use Livewire\Component;

class MainSearchBar extends Component
{
    public $input = '';

    public $selectedTags = [];

    public $filteredTags = [];

    protected $allTags;

    public $showDropdown = false;

    public function boot()
    {
        // Temporary mock data for tags (replace with database query later)
        $this->allTags = [
            ['id' => 1, 'content' => 'Haunted House', 'type' => TagType::Tag->getLabel()],
            ['id' => 2, 'content' => 'Supernatural', 'type' => TagType::Tag->getLabel()],
            ['id' => 3, 'content' => 'Family Drama', 'type' => TagType::Tag->getLabel()],
            ['id' => 4, 'content' => 'Psychological', 'type' => TagType::Tag->getLabel()],
            ['id' => 5, 'content' => 'Found Footage', 'type' => TagType::Tag->getLabel()],
            ['id' => 6, 'content' => 'Slasher', 'type' => TagType::Tag->getLabel()],
            ['id' => 7, 'content' => 'Zombie', 'type' => TagType::Tag->getLabel()],
            ['id' => 8, 'content' => 'Gore', 'type' => TagType::Tag->getLabel()],
            ['id' => 9, 'content' => 'Paranormal', 'type' => TagType::Tag->getLabel()],
            ['id' => 10, 'content' => 'Demonic', 'type' => TagType::Tag->getLabel()],
            ['id' => 11, 'content' => 'Cult', 'type' => TagType::Tag->getLabel()],
            ['id' => 12, 'content' => 'Classic', 'type' => TagType::Tag->getLabel()],
            ['id' => 13, 'content' => 'Modern', 'type' => TagType::Tag->getLabel()],
            ['id' => 14, 'content' => 'Indie', 'type' => TagType::Tag->getLabel()],
            ['id' => 15, 'content' => 'Award-Winning', 'type' => TagType::Tag->getLabel()],
        ];
    }

    public function updatedInput($value)
    {
        if (strlen($value) > 2) {
            $this->toggleDropdown();
            $value = trim(strtolower($value));
            $this->filteredTags = array_filter($this->allTags, function ($tag) use ($value) {
                return str_contains(strtolower($tag['content']), $value);
            });
        } else {
            $this->closeDropdown();
            $this->filteredTags = [];
        }
    }

    #[On('inputSelected')]
    public function handleInput()
    {
        $this->validate([
            'input' => 'required|string|max:30',
        ]);

        $this->addInputToSelectedTags();
    }

    public function addInputToSelectedTags()
    {
        $this->input = trim($this->input);

        if ($this->input) {
            if (! in_array($this->input, array_column($this->selectedTags, 'content'))) {
                $this->selectedTags[] = ['id' => 0, 'content' => $this->input, 'type' => TagType::Input->getLabel()];
            }
            $this->reset('input');
        }
    }

    #[On('tagSelected')]
    public function handleTagSelected($id, $content, $type)
    {
        $tagarr = ['id' => $id, 'content' => $content, 'type' => $type];

        if (! in_array($tagarr, $this->selectedTags)) {
            $this->selectedTags[] = ['id' => $id, 'content' => $content, 'type' => $type];
        }

        $this->reset('input');
    }

    #[On('tagRemoved')]
    public function handleTagRemoved($id, $content, $type)
    {
        $this->selectedTags = array_filter($this->selectedTags, function ($tag) use ($id, $content, $type) {
            return ! ($tag['id'] === $id && $tag['content'] === $content && $tag['type'] === $type);
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

    public function removeLastTag()
    {
        if (! $this->input) {
            $this->selectedTags = array_slice($this->selectedTags, 0, -1);
        }
    }

    public function render()
    {
        return view('livewire.main-search-bar.main-search-bar');
    }

    public function closeDropdown()
    {
        $this->showDropdown = false;
    }

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    #[On('submitSearch')]
    public function submitSearch()
    {
        $this->addInputToSelectedTags();

        if (! empty($this->selectedTags)) {
            dd($this->selectedTags);
        }
    }

    public function clearTags()
    {
        $this->reset('selectedTags');
    }
}
