<?php

namespace App\Livewire\MainSearchBar;

use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;
use App\View\Components\Tag\TagToUrlParameter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
     * @var Collection<array-key, array<string, mixed>>
     */
    public $selected;

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
     * @var Collection
     */
    public $tags;

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
    public function buildSelectedFromRequest($request = null)
    {
        $params = $this->urlHandler->getFromRequest($request ?? request());
        $this->selected = $this->selected->replace($this->urlHandler->fromRequestToSelected($params));

    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(
        ?Request $request = null,
    ) {
        $this->selected = $this->selected ?? collect();
        $this->tags = $this->tags ?? collect();

        $this->buildSelectedFromRequest($request ?? request());

        $this->searchTags($this->input);

    }

    /**
     * Updated the input value
     *
     * @param  string  $value
     * @return void
     */
    public function updatedInput($value)
    {
        $this->searchTags($value);
    }

    /**
     * Filter the tags
     *
     * @param  string  $value
     * @return void
     */
    public function searchTags($value)
    {
        $value = trim(strtolower($value));

        if (strlen($value) > 2) {
            $query = Tag::query()->where('name', 'ilike', '%'.$value.'%')->limit(10)->orderBy('name');

            $tags = $query->get()->keyBy('id');

            $this->setTags($tags);

            if ($this->countTags() > 0) {
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
     * @return void
     */
    #[Computed(persist: true)]
    public function setTags(Collection $value)
    {
        $this->tags = $value;

        if (empty($this->tags)) {
            $this->closeDropdown();
        } else {
            $this->setIndexToFirst();
        }
    }

    /**
     * Reset all the values
     *
     * @return void
     */
    public function resetAll()
    {
        $this->closeDropdown();
        $this->resetTags();
        $this->resetIndex();
        $this->resetInput();
        $this->resetSelected();
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
    // #[Computed(persist: true)]
    public function countTags(): int
    {
        return $this->tags->count();
    }

    /**
     * Reset the input
     *
     * @return void
     */
    public function resetInput()
    {
        $this->reset('input');
    }

    /**
     * Set the tag index to the last tag
     *
     * @return void
     */
    public function setIndexToLast()
    {
        $last = $this->tags->keys()->last();

        if ($last) {
            $this->setIndex($last);
        }
    }

    /**
     * Set the tag index to the first tag
     *
     * @return void
     */
    public function setIndexToFirst()
    {
        $first = $this->tags->keys()->first();

        if ($first) {
            $this->setIndex($first);
        }
    }

    /**
     * Next tag
     *
     * @return void
     */
    public function nextTagByIndex()
    {
        $keys = $this->tags->keys()->all();
        $keyPosition = array_search($this->getIndex(), $keys);

        if ($keyPosition !== false && $keyPosition < count($keys) - 1) {
            $nextIndex = $keys[$keyPosition + 1];
            $this->setIndex($nextIndex);
            $this->dispatch('scrollmaindropdowndown');
        }
    }

    /**
     * Previous tag
     *
     * @return void
     */
    public function previousTagByIndex()
    {
        $keys = $this->tags->keys()->all();
        $keyPosition = array_search($this->getIndex(), $keys);

        if ($keyPosition !== false && $keyPosition > 0) {
            $prevIndex = $keys[$keyPosition - 1];
            $this->setIndex($prevIndex);
            $this->dispatch('scrollmaindropdownup');
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
     */
    public function pushInputToSelected(): bool
    {
        $applied = false;
        $this->input = trim($this->input);

        if ($this->input > 2) {

            $params = ['name' => $this->input, 'type' => UrlParamType::INPUT];
            $checksum = $this->urlHandler->generateChecksum($params);
            $params['id'] = $checksum;
            $inputTag = new TagToUrlParameter($params);

            $this->selected[$checksum] = $inputTag->toArray();

            $this->closeDropdown;
            $this->resetInput();
            $this->dispatch('scrollmaininputsearch');
            $applied = true;
        }

        return $applied;
    }

    /**
     * Set the selected tags
     *
     * @return void
     */
    public function setSelected(Collection $value)
    {
        $this->selected = $value;
    }

    /**
     * Add the tag to the selected tags
     *
     * @param  string  $index
     * @return void
     */
    public function addToSelectedFromTagsIndex($index)
    {
        if (! isset($this->selected[$index])) {
            $this->selected[$index] = $this->tags[$index]->toArray();
        }
    }

    /**
     * Add the tag to the selected tags
     *
     * @return void
     */
    public function addToSelected(array $tag)
    {
        $this->selected[$tag['id']] = $tag;
    }

    /**
     * Remove the tag from the selected tags
     *
     * @param  string  $index
     * @return void
     */
    public function removeFromSelectedFromIndex($index)
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
     * dummy event to Scroll the main input search
     *
     * @return void
     */
    #[On('scrollmaininputsearch')]
    public function scrollMainInputSearch() {}

    /**
     * dummy event to Scroll the main dropdown
     *
     * @return void
     */
    #[On('scrollmaindropdowndown')]
    public function scrollMainDropdownDown() {}

    /**
     * dummy event to Scroll the main dropdown
     *
     * @return void
     */
    #[On('scrollmaindropdownup')]
    public function scrollMainDropdownUp() {}

    /**
     * Toggle the tag by $this->index
     */
    public function toggleTagByInternalIndex(): void
    {
        $this->toggleTag($this->index);
    }

    /**
     * Toggle the tag on selected tags
     */
    #[On('toggletag')]
    public function toggleTag($index): void
    {
        if (isset($this->selected[$index])) {
            $this->removeFromSelectedFromIndex($index);
        } else {
            $this->addToSelectedFromTagsIndex($index);
        }
        $this->resetInput();
        $this->closeDropdown();
        $this->dispatch('scrollmaininputsearch');
    }

    /**
     * Toggle the tag from the site
     *
     * @return void
     */
    #[On('toggletagfromsite')]
    public function toggleTagFromSite(array $modelarray)
    {
        if (! empty($modelarray['id'])) {

            try {
                $tag = Tag::find($modelarray['id']);
            } catch (ModelNotFoundException $e) {
                return;
            }

            $tag = new TagToUrlParameter($tag->toArray());
            $id = $tag->id;

            if (isset($this->selected[$id])) {
                $this->removeFromSelectedFromIndex($id);
            } else {
                $this->addToSelected($tag->toArray());
            }
        }
    }

    /**
     * Remove the last tag
     *
     * @return void
     */
    public function removeLastTag()
    {
        if (! $this->input) {
            $this->selected = $this->selected->slice(0, -1);
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
        $this->resetIndex();
        $this->resetTags();
    }

    /**
     * Reset the tags
     *
     * @return void
     */
    public function resetTags()
    {
        $this->reset('tags');
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
        if ($this->showDropdown) {
            $this->toggleTagByInternalIndex();
        } elseif (! empty($this->selected)) {
            $params = $this->urlHandler->fromSelectedToUrl($this->selected);
            $this->redirectRoute('movie.search', $params, navigate: true);
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
