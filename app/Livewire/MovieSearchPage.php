<?php

namespace App\Livewire;

use App\Livewire\MainSearchBar\MainSearchBar;
use App\Livewire\MainSearchBar\SearchUrlParameters;
use App\Models\Post\Post;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Component;
use Livewire\WithPagination;

class MovieSearchPage extends Component
{
    use WithPagination;

    const DEFAULT_PAGE = 1;

    const PER_PAGE = 12;

    /**
     * Filter properties
     *
     * @var array|null
     */
    #[Session('main-search-bar.filters')]
    public $filters = null;

    /**
     * The tag
     *
     * @var array|null
     */
    public $tag = null;

    /**
     * The input
     *
     * @var array|null
     */
    public $input = null;

    /**
     * The movies
     *
     * @var \Illuminate\Pagination\LengthAwarePaginator
     */
    #[Computed(persist: true)]
    public function movies()
    {
        $query = $this->getMoviesQuery()->orderBy('release_date', 'desc');

        // Log::info($query->toSql());

        return $query->paginate($this->getPerPage());
    }

    /**
     * The URL parameters handler
     */
    protected SearchUrlParameters $urlHandler;

    /**
     * Get the movies query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getMoviesQuery()
    {
        return Post::query()->with(['year', 'genre', 'media'])
            ->when($this->getStartDate(), function ($query) {
                $query->where('release_date', '>=', $this->getStartDate());
            })
            ->when($this->getEndDate(), function ($query) {
                $query->where('release_date', '<=', $this->getEndDate());
            })
            ->when($this->getRating(), function ($query) {
                $query->where('rating', '>=', $this->getRating());
            })->when($this->getTag(), function ($query) {
                $query->whereHas('tags', function ($query) {
                    if ($this->getSearchType()) { // if search type is AND
                        foreach ($this->getTag() as $tag) {
                            $query->where('tags.id', $tag);
                        }
                    } else {
                        $query->whereIn('tags.id', $this->getTag());
                    }
                });
            })->when($this->getInput(), function ($query) {
                if ($this->getSearchType()) { // if search type is AND
                    $query->where(function ($query) {
                        $input = $this->getInput();
                        foreach ($input as $key => $value) {
                            $query->where('title', 'like', '%'.$value.'%')
                                ->orWhere('description', 'like', '%'.$value.'%');
                        }
                    });
                } else {
                    $query->orWhere(function ($query) {
                        $input = $this->getInput();
                        foreach ($input as $key => $value) {
                            $query->where('title', 'like', '%'.$value.'%')
                                ->orWhere('description', 'like', '%'.$value.'%');
                        }
                    });
                }
            });
    }

    /**
     * Boot the component
     *
     * @return void
     */
    public function boot() {}

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount()
    {
        // only build params when page is refreshed
        $this->buildParamsFromRequest();
    }

    /**
     * Get the search type
     *
     * @return array
     */
    public function getSearchType()
    {
        return $this->filters['st'] ?? null;
    }

    /**
     * Get the input
     *
     * @return array
     */
    public function getInput()
    {
        return empty($this->input) ? null : $this->input;
    }

    /**
     * Get the tag
     *
     * @return array
     */
    public function getTag()
    {
        return empty($this->tag) ? null : $this->tag;
    }

    /**
     * Get the start date
     *
     * @return array
     */
    public function getStartDate()
    {
        return $this->filters['start_date'] ?? null;
    }

    /**
     * Get the end date
     *
     * @return array
     */
    public function getEndDate()
    {
        return $this->filters['end_date'] ?? null;
    }

    /**
     * Get the rating
     *
     * @return array
     */
    public function getRating()
    {
        return $this->filters['rating'] ?? null;
    }

    /**
     * Get the per page
     *
     * @return int
     */
    public function getPerPage()
    {
        return $this->filters['perPage'] ?? null;
    }

    /**
     * Get the page
     *
     * @return int
     */
    public function getPage()
    {
        return $this->filters['page'] ?? null;
    }

    /**
     * Build the selected tags from the request
     *
     * @param  Request|null  $request
     * @return void
     */
    public function buildParamsFromRequest($request = null)
    {
        $this->urlHandler = new SearchUrlParameters;
        $params = $this->urlHandler->getFromRequest($request ?? request());

        $this->setTag($params[UrlParamType::TAG->value] ?? null);
        $this->setInput($params[UrlParamType::INPUT->value] ?? null);

        $this->setFilters(
            collect($this->filters)->merge(
                collect($params)->except('tag', 'input', 'perPage')
            )->toArray());

    }

    /**
     * Set the filters
     *
     * @param  array  $filters
     * @return void
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    /**
     * Set the tag
     *
     * @param  array|null  $tag
     * @return void
     */
    public function setTag($tag)
    {
        $this->tag = empty($tag) ? null : $tag;
    }

    /**
     * Set the search type
     *
     * @param  array|null  $searchType
     * @return void
     */
    public function setSearchType($searchType)
    {
        $this->filters['st'] = $searchType;
    }

    /**
     * Set the input
     *
     * @param  array|null  $input
     * @return void
     */
    public function setInput($input)
    {
        $this->input = empty($input) ? null : $input;
    }

    /**
     * Apply filters
     *
     * @return void
     */
    public function applyFilters()
    {
        $this->unsetPage();

        $this->dispatch('submitSearch', filters: array_filter($this->getFilters() ?: []))
            ->to(MainSearchBar::class);
    }

    /**
     * Unset the page
     *
     * @return void
     */
    protected function unsetPage()
    {
        unset($this->filters['page']);
    }

    /**
     * Unset the per page
     *
     * @return void
     */
    protected function unsetPerPage()
    {
        unset($this->filters['perPage']);
    }

    /**
     * Unset the search type
     *
     * @return void
     */
    protected function unsetSearchType()
    {
        unset($this->filters['st']);
    }

    /**
     * Reset the per page
     *
     * @return void
     */
    public function resetPerPage()
    {
        $this->filters['perPage'] = self::PER_PAGE;
    }

    /**
     * Reset the search type
     *
     * @return void
     */
    public function resetSearchType()
    {
        $this->setSearchType(null);
    }

    /**
     * Reset the page
     *
     * @return void
     */
    public function resetPage()
    {
        $this->filters['page'] = self::DEFAULT_PAGE;
    }

    /**
     * Reset the input
     *
     * @return void
     */
    public function resetInput()
    {
        $this->setInput(null);
    }

    /**
     * Reset the tag
     *
     * @return void
     */
    public function resetTag()
    {
        $this->setTag(null);
    }

    /**
     * Reset the start date
     *
     * @return void
     */
    public function resetStartDate()
    {
        $this->filters['start_date'] = null;
    }

    /**
     * Reset the end date
     *
     * @return void
     */
    public function resetEndDate()
    {
        $this->filters['end_date'] = null;
    }

    /**
     * Reset the rating
     *
     * @return void
     */
    public function resetRating()
    {
        $this->filters['rating'] = null;
    }

    /**
     * Reset the filters
     *
     * @return void
     */
    public function resetAll()
    {
        $this->resetInput();
        $this->resetTag();
        $this->unsetFilters();

        $this->dispatch('submitSearch')
            ->to(MainSearchBar::class);
    }

    /**
     * Unset the filters
     *
     * @return void
     */
    protected function unsetFilters()
    {
        unset($this->filters);
    }

    /**
     * Get the filters
     *
     * @return array
     */
    public function getFilters()
    {
        return empty($this->filters) ? null : $this->filters;
    }

    /**
     * Set the rating
     *
     * @param  int  $rating
     * @return void
     */
    public function setRating($rating)
    {
        $this->filters['rating'] = $rating;
    }

    /**
     * Render the component
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.page.movie-search-page', [
            'movies' => $this->movies,
        ]);
    }
}
