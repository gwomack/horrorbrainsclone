<?php

namespace App\Livewire\MainSearchBar;

use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class MainSearchBar extends Component
{
    /**
     * The URL parameters handler
     */
    protected SearchUrlParameters $urlHandler;

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
        $this->urlHandler = new SearchUrlParameters;
    }

    /**
     * Build the selected tags from the request
     *
     * @return void
     */
    public function buildSelectedFromRequest()
    {
        $params = $this->urlHandler->getFromRequest(request());
        $this->selected = $this->urlHandler->toSelected($params);
    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount()
    {
        $this->filterTags($this->input);

        $this->buildSelectedFromRequest();
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
            $query = Tag::query()->where('name', 'ilike', '%'.$value.'%')->limit(10)->orderBy('name');

            $tags = $query->get()->map(function ($tag) {
                return ['id' => $tag->getKey(), 'content' => ['content' => $tag->name, 'type' => UrlParamType::TAG]];
            })->pluck('content', 'id')->toArray();

            $this->setTags($tags);

            if ($this->countTags() > 0) {
                $this->openDropdown();
            } else {
                $this->closeDropdown();
            }
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
        if ($this->index == '' && $this->countTags() > 0) {
            $this->setIndexToFirst();
        }

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
        $keyPosition = array_search($this->getIndex(), $keys);

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
        $keyPosition = array_search($this->getIndex(), $keys);

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

            $inputTag = ['content' => $this->input, 'type' => UrlParamType::INPUT];
            $checksum = hash('crc32b', json_encode($inputTag));

            if (! isset($this->selected[$checksum])) {
                $this->selected[$checksum] = $inputTag;
            }

            $this->reset('showDropdown', 'input');
        }
    }

    /**
     * Get the checksum of the input tag
     *
     * @param  array  $inputTag
     * @return string
     */
    protected function checksumOfInputTag($inputTag)
    {
        return hash('crc32b', json_encode($inputTag));
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
            $this->reset('input');
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
     * Toggle the tag from the site
     *
     * @param  string  $id
     * @param  string  $content
     * @param  UrlParamType  $type
     * @return void
     */
    #[On('toggletagfromsite')]
    public function toggleTagFromSite($id, $content, $type)
    {
        if (isset($this->selected[$id])) {
            unset($this->selected[$id]);
        } else {
            $this->selected[$id] = ['content' => $content, 'type' => $type];
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
            $params = $this->urlHandler->toUrlParameters($this->selected);
            $this->redirect(route('movie.search', $params), navigate: true);
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
