<?php

namespace App\Livewire\MainSearchBar;

use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;
use App\View\Components\Tag\TagToUrlParameter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
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
    // #[Session('main-search-bar.selected')]
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
    public function boot(
        ?Request $request = null,
    ) {
        $this->urlHandler = new SearchUrlParameters;

        $this->selected = $this->selected ?? collect();

        $this->tags = $this->tags ?? collect();

        $this->buildSelectedFromRequest($request ?? request());
    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount()
    {
        $this->searchTags($this->input);
    }

    /**
     * Hydrate the component
     *
     * @return void
     */
    public function hydrate()
    {
        $this->buildSelectedFromRequest($request ?? request());

    }

    /**
     * Replace the selected tags
     *
     * @return void
     */
    protected function replaceSelected(Collection $replace)
    {
        $this->selected = $this->selected->replace($replace);
    }

    /**
     * Build the selected tags from the request
     *
     * @return void
     */
    public function buildSelectedFromRequest($request = null)
    {
        $params = $this->urlHandler->getFromRequest($request ?? request());
        // Log::debug('buildSelectedFromRequest', ['params' => $params]);
        $this->replaceSelected($this->urlHandler->fromRequestToSelected($params));
        // Log::debug('buildSelectedFromRequest', ['selected' => $this->selected]);
    }

    /**
     * Build the filters from the request
     *
     * @return void
     */
    public function buildFiltersFromRequest($request = null)
    {
        $params = $this->urlHandler->getFromRequest($request ?? request());
        $this->setFilters($this->urlHandler->fromRequestToFilters($params));
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
    public function resetAll($url = null)
    {
        $this->closeDropdown();
        $this->resetTags();
        $this->resetIndex();
        $this->resetInput();
        $this->resetSelected();

        $this->submitSearch(
            url()->livewire_current()
        );
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
    #[On('pushinputtoselected')]
    public function pushInputToSelected($input = null): void
    {
        $input = $input ?? $this->input;
        $input = trim($input);

        if (strlen($input) > 2) {

            $params = ['name' => $input, 'type' => UrlParamType::INPUT];
            $checksum = generateChecksum($params);
            $params['id'] = $checksum;
            $inputTag = new TagToUrlParameter($params);

            $this->addToSelected($inputTag->toArray());

            $this->closeDropdown();
            // $this->resetInput();
            $this->reset('input');
            // $this->dispatch('scrollrightmaininputsearch');
        }
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
        if (! isset($this->selected[$index]) && isset($this->tags[$index])) {
            $this->addToSelected($this->tags[$index]->toArray());
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
        $this->dispatch('scrollrightmaininputsearch');
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
        $this->dispatch('scrollleftmaininputsearch');
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
    public function toggleTag(string $index): void
    {
        if (isset($this->selected[$index])) {
            $this->removeFromSelectedFromIndex($index);
        } else {
            $this->addToSelectedFromTagsIndex($index);
        }
        $this->resetInput();
        $this->closeDropdown();
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
     * Add the tag from the site
     *
     * @return void
     */
    #[On('addtagfromsite')]
    public function addTagFromSite(array $modelarray, $navigate = false)
    {
        if (! empty($modelarray['id'])) {

            try {
                $tag = Tag::find($modelarray['id']);
            } catch (ModelNotFoundException $e) {
                return;
            }

            if (! isset($this->selected[$modelarray['id']])) {
                $tag = new TagToUrlParameter($tag->toArray());
                $this->addToSelected($tag->toArray());
                $this->dispatchRefresh();
            }

            if ($navigate) {
                return $this->submitSearch();
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
     * Close the dropdown
     *
     * @return void
     */
    #[On('closeDropdown')]
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
        $this->tags = null;
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
     * Get the filters
     *
     * @return array
     */
    protected function getFilters()
    {
        return session()->get('main-search-bar.filters') ?: [];
    }

    /**
     * Submit the search
     *
     * @return void
     */
    #[On('submitSearch', ['routeName'])]
    public function submitSearch(?array $routeArr = null)
    {
        if ($this->showDropdown) {

            $this->toggleTagByInternalIndex();

        } else {

            $routeArr = $routeArr ?? ['name' => 'movie.search', 'parameters' => []];

            $this->dispatchRefresh();
            $this->pushInputToSelected();
            $params = $this->urlHandler->fromSelectedToUrl($this->selected);
            $params = array_filter(array_merge($this->getFilters(), $params));
            $params = array_filter(array_merge($routeArr['parameters'], $params));
            // dd($routeArr['name'], $params);
            $this->redirectRoute($routeArr['name'], $params, navigate: true);
        }
    }

    /**
     * Dispatch the refresh event
     *
     * @return void
     */
    public function dispatchRefresh()
    {
        $this->dispatch('main-searchbar-refresh');
    }

    /**
     * Reset the selected tags
     *
     * @return void
     */
    public function resetSelected()
    {
        $this->selected = null;
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
}
