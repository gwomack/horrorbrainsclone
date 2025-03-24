<?php

namespace App\Livewire\MainSearchBar;

use App\Models\Tag\TagType;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class MainSearchBar extends Component
{
    /**
     * The input value for the search bar
     *
     * @var string
     */
    public $input = '';

    /**
     * The selected tags for the search bar
     *
     * @var array
     */
    public $selected = [];

    /**
     * The filtered tags for the search bar
     * TODO: this should not exist once connected to the database
     *
     * @var array
     */
    protected $allTags;

    /**
     * Whether the dropdown is visible
     *
     * @var bool
     */
    public $showDropdown = false;

    /**
     * The index of the tag
     *
     * @var string
     */
    public $index = '';

    /**
     * The list tags for the search bar
     *
     * @var array
     */
    public $tags = [];

    /**
     * Boot the component
     *
     * @return void
     */
    public function boot()
    {
        // Temporary mock data for tags (replace with database query later)
        $type = TagType::Tag->getLabel();
        $this->allTags = [
            1 => ['content' => 'Haunted House', 'type' => $type],
            2 => ['content' => 'Supernatural', 'type' => $type],
            3 => ['content' => 'Family Drama', 'type' => $type],
            4 => ['content' => 'Psychological', 'type' => $type],
            5 => ['content' => 'Found Footage', 'type' => $type],
            6 => ['content' => 'Slasher', 'type' => $type],
            7 => ['content' => 'Zombie', 'type' => $type],
            8 => ['content' => 'Gore', 'type' => $type],
            9 => ['content' => 'Paranormal', 'type' => $type],
            10 => ['content' => 'Demonic', 'type' => $type],
            11 => ['content' => 'Cult', 'type' => $type],
            12 => ['content' => 'Classic', 'type' => $type],
            13 => ['content' => 'Modern', 'type' => $type],
            14 => ['content' => 'Indie', 'type' => $type],
            15 => ['content' => 'Award-Winning', 'type' => $type],
            16 => ['content' => 'Haunted House1', 'type' => $type],
            17 => ['content' => 'Haunted House2', 'type' => $type],
            18 => ['content' => 'Haunted House3', 'type' => $type],
            19 => ['content' => 'Haunted House4', 'type' => $type],
            20 => ['content' => 'Haunted House5', 'type' => $type],
        ];
    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount()
    {
        $this->filterTags($this->input);

        if ($this->countTags() === 0) {
            return;
        }
    }

    /**
     * Updated the input value
     *
     * @param  string  $value
     * @return void
     */
    public function updatedInput($value)
    {
        $this->filterTags($value);
    }

    /**
     * Filter the tags
     *
     * @param  string  $value
     * @return void
     */
    public function filterTags($value)
    {
        $value = trim(strtolower($value));

        if (strlen($value) > 2) {

            $this->setTags(
                // TODO: this should not exist once connected to the database
                collect($this->allTags)->filter(fn ($tag) => str_contains(strtolower($tag['content']), $value))->toArray()
            );

            if (count($this->tags) > 0) {
                $this->openDropdown();
            } else {
                $this->closeDropdown();
            }
        } else {
            $this->closeDropdown();
        }
    }

    /**
     * Set the tags
     *
     * @param  array  $value
     * @return void
     */
    #[Computed(persist: true)]
    public function setTags($value)
    {
        $this->tags = $value;

        if (empty($this->tags)) {
            $this->resetIndex();
        } else {
            $this->setIndexToFirst();
        }
    }

    /**
     * Reset the dropdown
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('tags', 'showDropdown', 'index', 'input', 'selected');
    }

    /**
     * Set the tag index
     *
     * @param  string  $index
     * @return void
     */
    public function setIndex($index)
    {
        $this->index = (string) $index;
    }

    /**
     * Get the tag index
     *
     * @return string
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Check if the index is the same as the given index
     *
     * @param  string  $index
     * @return bool
     */
    public function isOnIndex($index)
    {
        return $this->index == $index;
    }

    /**
     * Reset the index
     *
     * @return void
     */
    public function resetIndex()
    {
        $this->reset('index');
    }

    /**
     * Get the count of tags
     */
    #[Computed(persist: true)]
    public function countTags(): int
    {
        return count($this->tags);
    }

    /**
     * Set the tag index to the last tag
     *
     * @return void
     */
    public function setIndexToLast()
    {
        $last = array_key_last($this->tags);

        if ($last) {
            $this->index = $last;
        }
    }

    /**
     * Set the tag index to the first tag
     *
     * @return void
     */
    public function setIndexToFirst()
    {
        $first = array_key_first($this->tags);

        if ($first) {
            $this->index = $first;
        }
    }

    /**
     * Next tag
     *
     * @return void
     */
    public function nextTagByIndex()
    {
        $keys = array_keys($this->tags);
        $keyPosition = array_search($this->index, $keys);

        if ($keyPosition !== false && $keyPosition < count($keys) - 1) {
            $nextIndex = $keys[$keyPosition + 1];
            $this->setIndex($nextIndex);
        }
    }

    /**
     * Previous tag
     *
     * @return void
     */
    public function previousTagByIndex()
    {
        $keys = array_keys($this->tags);
        $keyPosition = array_search($this->index, $keys);

        if ($keyPosition !== false && $keyPosition > 0) {
            $prevIndex = $keys[$keyPosition - 1];
            $this->setIndex($prevIndex);
        }
    }

    /**
     * Handle the input selected event
     *
     * @return void
     */
    #[On('inputSelected')]
    public function handleInput()
    {
        $this->validate([
            'input' => 'required|string|max:30',
        ]);

        $this->pushInputToSelected();
    }

    /**
     * Push the input to the selected tags
     *
     * @return void
     */
    public function pushInputToSelected()
    {
        $this->input = trim($this->input);

        if ($this->input) {

            $inputTag = ['content' => $this->input, 'type' => TagType::Input->getLabel()];
            $checksum = hash('crc32b', json_encode($inputTag));

            if (! isset($this->selected[$checksum])) {
                $this->selected[$checksum] = $inputTag;
            }

            $this->reset('showDropdown', 'input');
        }
    }

    /**
     * Add the tag to the selected tags
     *
     * @param  string  $index
     * @return void
     */
    public function addToSelected($index)
    {
        if (! isset($this->selected[$index])) {
            $this->selected[$index] = $this->tags[$index];
        }
    }

    /**
     * Remove the tag from the selected tags
     *
     * @param  string  $index
     * @return void
     */
    public function removeFromSelected($index)
    {
        unset($this->selected[$index]);
    }

    /**
     * Check if the tag is selected
     *
     * @param  string  $index
     * @return bool
     */
    public function isSelected($index)
    {
        $isSelected = isset($this->selected[$index]);

        return $isSelected;
    }

    /**
     * Toggle the tag on selected tags
     *
     * @return void
     */
    #[On('toggletag')]
    public function toggleTag($index)
    {
        if (isset($this->selected[$index])) {
            $this->removeFromSelected($index);
        } else {
            $this->addToSelected($index);
        }
    }

    /**
     * Toggle the tag by index
     *
     * @return void
     */
    #[On('toggletagbyindex')]
    public function toggleTagByIndex()
    {
        if (isset($this->selected[$this->index])) {
            $this->removeFromSelected($this->index);
        } else {
            $this->addToSelected($this->index);
        }

        $this->reset('input');
    }

    /**
     * Remove the last tag
     *
     * @return void
     */
    public function removeLastTag()
    {
        if (! $this->input) {
            $this->selected = array_slice($this->selected, 0, -1);
        }
    }

    /**
     * Render the component
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.main-search-bar.main-search-bar');
    }

    /**
     * Close the dropdown
     *
     * @return void
     */
    public function closeDropdown()
    {
        $this->reset('showDropdown');
    }

    /**
     * Open the dropdown
     *
     * @return void
     */
    public function openDropdown()
    {
        $this->showDropdown = true;
    }

    /**
     * Toggle the dropdown
     *
     * @return void
     */
    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    /**
     * Submit the search
     *
     * @return void
     */
    #[On('submitSearch')]
    public function submitSearch()
    {
        $this->pushInputToSelected();

        if (! empty($this->selected)) {
            dd($this->selected);
        }
    }

    /**
     * Reset the selected tags
     *
     * @return void
     */
    public function resetSelected()
    {
        $this->reset('selected');
    }
}
