<?php

namespace App\Livewire\Tag;

use App\Models\Tag\TagType;
use Livewire\Attributes\On;
use Livewire\Component;

class TagCombobox extends Component
{
    #[Reactive]
    public $search = '';

    public $selectedTags = [];

    public $showDropdown = false;

    protected $allTags;

    public function boot()
    {
        // Temporary mock data for tags (replace with database query later)
        $this->allTags = [
            ['id' => 1, 'content' => 'Haunted House', 'type' => TagType::TAG->getLabel()],
            ['id' => 2, 'content' => 'Supernatural', 'type' => TagType::TAG->getLabel()],
            ['id' => 3, 'content' => 'Family Drama', 'type' => TagType::TAG->getLabel()],
            ['id' => 4, 'content' => 'Psychological', 'type' => TagType::TAG->getLabel()],
            ['id' => 5, 'content' => 'Found Footage', 'type' => TagType::TAG->getLabel()],
            ['id' => 6, 'content' => 'Slasher', 'type' => TagType::TAG->getLabel()],
            ['id' => 7, 'content' => 'Zombie', 'type' => TagType::TAG->getLabel()],
            ['id' => 8, 'content' => 'Gore', 'type' => TagType::TAG->getLabel()],
            ['id' => 9, 'content' => 'Paranormal', 'type' => TagType::TAG->getLabel()],
            ['id' => 10, 'content' => 'Demonic', 'type' => TagType::TAG->getLabel()],
            ['id' => 11, 'content' => 'Cult', 'type' => TagType::TAG->getLabel()],
            ['id' => 12, 'content' => 'Classic', 'type' => TagType::TAG->getLabel()],
            ['id' => 13, 'content' => 'Modern', 'type' => TagType::TAG->getLabel()],
            ['id' => 14, 'content' => 'Indie', 'type' => TagType::TAG->getLabel()],
            ['id' => 15, 'content' => 'Award-Winning', 'type' => TagType::TAG->getLabel()],
        ];
    }

    public function render()
    {
        $filteredTags = collect($this->allTags)
            ->filter(function ($tag) {
                return str_contains(strtolower($tag['content']), strtolower($this->search));
            })
            ->toArray();

        return view('livewire.tag.tag-combobox', [
            'filteredTags' => $filteredTags,
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

        if (! in_array($tagarr, array_column($this->selectedTags, 'id'))) {
            $this->selectedTags[] = ['id' => $id, 'content' => $content, 'type' => $type];
        }
    }

    #[On('toggletag')]
    public function toggletag($id, $content, $type)
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

    #[On('toggleDropdown')]
    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }
}
