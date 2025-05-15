<?php

namespace App\Livewire\MovieSearchPage;

use Livewire\Component;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Livewire\UrlParamType;
use Livewire\Attributes\Session;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Log;
use App\Livewire\MainSearchBar\MainSearchBar;
use App\Livewire\MainSearchBar\SearchUrlParameters;

class MovieSearchPage extends Component
{
    use WithPagination;

    const DEFAULT_PAGE = 1;

    const DEFAULT_PER_PAGE = 12;

    /**
     * Filter properties
     *
     * @var array|null
     */
    // #[Session('main-search-bar.filters')]
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
     * The request
     *
     * @var Request|null
     */
    protected Request|null $request = null;

    /**
     * Boot the component
     * called first every time
     *
     * @return void
     */
    public function boot() {}

    /**
     * Mount the component
     * called when page is first loaded
     *
     * @return void
     */
    public function mount(Request|null $request = null)
    {
        // only build params when page is refreshed
        $this->request = $request;
        $this->buildParamsFromRequest();
    }

    /**
     * Perform actions before the component is updated on the screen
     * this is not called when the component is mounted
     * ref: https://app.studyraid.com/en/read/11454/358970/component-hydration-and-dehydration
     */
    public function hydrate()
    {
        $condition = data_get(request('components'), '*.calls.*.method');
        // Log::debug($condition);
        foreach (['previousPage', 'nextPage', 'gotoPage'] as $method) {
            if (in_array($method, $condition)) {
                unset($this->movies);
            }
        }
    }

    /**
     * Render the component
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Log::debug($this->filters);

        return view('livewire.page.movie-search-page', [
            'movies' => $this->movies,
            'orderByTypes' => $this->orderByTypes,
            'orderDirectionTypes' => $this->orderDirectionTypes,
            'perPageTypes' => $this->perPageTypes,
        ]);
    }

    /**
     * Clean up sensitive data before sending to client
     * this is always called before sending to client after the render
     */
    public function dehydrate() {}

    /**
     * Build the selected tags from the request
     * use it at mounting time
     *
     * @param  Request|null  $request
     * @return void
     */
    public function buildParamsFromRequest()
    {
        $this->urlHandler = new SearchUrlParameters;
        $params = $this->urlHandler->getFromRequest($this->request ?? request());

        $this->setTag($params[UrlParamType::TAG->value] ?? null);
        $this->setInput($params[UrlParamType::INPUT->value] ?? null);

        // Log::debug($params);

        $this->setFilters(
            collect($params)->only(
                'order_by', 'order_direction', 'start_date', 'end_date', 'rating',
                'per_page', 'page', 'st'
            )->toArray()
        );
    }

    /**
     * The movies
     *
     * @var \Illuminate\Pagination\LengthAwarePaginator
     */
    #[Computed(persist: true)]
    public function movies()
    {
        // Log::debug($this->getOrderBy());
        // Log::debug($this->getOrderDirection());

        $query = $this->getMoviesQuery()
            ->orderBy('title', 'asc');

        // Log::info($query->toSql());

        return $query->paginate($this->getPerPage());
    }

    /**
     * Get the order by
     *
     * @return string
     */
    #[Computed(cache: true)]
    public function orderByTypes()
    {
        return OrderByType::forSelect();
    }

    /**
     * Get the per page types
     *
     * @return array
     */
    #[Computed(cache: true)]
    public function perPageTypes()
    {
        return PerPageType::forSelect();
    }

    /**
     * Get the order direction types
     *
     * @return array
     */
    #[Computed(cache: true)]
    public function orderDirectionTypes()
    {
        return OrderDirectionType::forSelect();
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
        $post = Post::published()->with(['year', 'genre', 'media']);

        $isTrending = $this->getOrderBy() === OrderByType::TRENDING->value;
        $isReleaseDate = $this->getOrderBy() === OrderByType::RELEASE_DATE->value;
        $isComments = $this->getOrderBy() === OrderByType::COMMENTS->value;
        $isVotes = $this->getOrderBy() === OrderByType::VOTES->value;

        // Log::debug($this->getFilters());

        return $post->when($isTrending, function ($query) use ($post) {
            return $post->trendingPosts();
        })->when($isReleaseDate, function ($query) {
            return $query->orderByRaw("CASE WHEN release_date IS NULL THEN 0 ELSE 1 END DESC");
        })->when(!$isTrending, function ($query) {
            return $query->orderBy($this->getOrderBy(), $this->getOrderDirection());
        })->when($isComments, function ($query) {
            return $query->withCount(['comments' => function ($query) {
                $query->approved();
            }]);
        })->when($isVotes, function ($query) {
            return $query->withCount('postRatings');
        })->when($this->getStartDate(), function ($query) {
            $query->where('release_date', '>=', $this->getStartDate());
        })->when($this->getEndDate(), function ($query) {
            $query->where('release_date', '<=', $this->getEndDate());
        })->when($this->getRating(), function ($query) {
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
                        $query->where('posts.title', 'ilike', '%'.$value.'%')
                            ->orWhere('posts.description', 'ilike', '%'.$value.'%');
                    }
                });
            } else {
                $query->where(function ($query) {
                    $input = $this->getInput();
                    foreach ($input as $key => $value) {
                        $query->orWhere(function ($query) use ($value) {
                            $query->where('posts.title', 'ilike', '%'.$value.'%')
                                ->orWhere('posts.description', 'ilike', '%'.$value.'%');
                        });
                    }
                });
            }
        });
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
        // return optional(session()->get('main-search-bar.selected'))->pluck('id') ?: [];
        return empty($this->tag) ? null : $this->tag;
    }

    /**
     * Get the search type
     *
     * @return array
     */
    public function getSearchType()
    {
        return $this->filters['st'];
    }

    /**
     * Get the order by
     *
     * @return array
     */
    public function getOrderBy()
    {
        return $this->filters['order_by'];
    }

    /**
     * Get the order direction
     *
     * @return string
     */
    public function getOrderDirection()
    {
        return $this->filters['order_direction'];
    }

    /**
     * Get the start date
     *
     * @return array
     */
    public function getStartDate()
    {
        return $this->filters['start_date'];
    }

    /**
     * Get the end date
     *
     * @return array
     */
    public function getEndDate()
    {
        return $this->filters['end_date'];
    }

    /**
     * Get the rating
     *
     * @return array
     */
    public function getRating()
    {
        return $this->filters['rating'];
    }

    /**
     * Get the per page
     *
     * @return int
     */
    public function getPerPage()
    {
        return $this->filters['per_page'];
    }

    /**
     * Get the page
     *
     * @return int
     */
    public function getPage()
    {
        return $this->filters['page'];
    }

    /**
     * Get the filters
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
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
     * Set the filters
     *
     * @param  array  $filters
     * @return void
     */
    public function setFilters($filters)
    {
        $this->setOrderBy($filters['order_by'] ?? null);
        $this->setOrderDirection($filters['order_direction'] ?? null);
        $this->setPerPage($filters['per_page'] ?? null);
        $this->setPage($filters['page'] ?? null);
        $this->setSearchType($filters['st'] ?? null);
        $this->setStartDate($filters['start_date'] ?? null);
        $this->setEndDate($filters['end_date'] ?? null);
        $this->setRating($filters['rating'] ?? null);
    }

    /**
     * Set the order by
     *
     * @param  array|null  $order_by
     * @return void
     */
    public function setOrderBy($order_by)
    {
        $this->filters['order_by'] = OrderByType::getValue($order_by);
    }

    /**
     * Set the order direction
     *
     * @param  string|null  $order_direction
     * @return void
     */
    public function setOrderDirection($order_direction)
    {
        $this->filters['order_direction'] = OrderDirectionType::getValue($order_direction);
    }

    /**
     * Set the start date
     *
     * @param  string|null  $startDate
     * @return void
     */
    public function setStartDate($startDate)
    {
        $this->filters['start_date'] = $startDate;
    }

    /**
     * Set the end date
     *
     * @param  string|null  $endDate
     * @return void
     */
    public function setEndDate($endDate)
    {
        $this->filters['end_date'] = $endDate;
    }

    /**
     * Set the search type
     *
     * @param  array|null  $searchType
     * @return void
     */
    public function setSearchType($searchType)
    {
        $this->filters['st'] = (bool) $searchType;
    }

    /**
     * Set the per page
     *
     * @param  int|null  $per_page
     * @return void
     */
    public function setPerPage($per_page)
    {
        // Log::debug($per_page);

        $this->filters['per_page'] = PerPageType::getValue($per_page);
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
     * Unset the page
     *
     * @return void
     */
    protected function unsetPage()
    {
        unset($this->filters['page']);
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
        $this->setStartDate(null);
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

        $this->dispatch('submitSearch', )
            ->to(MainSearchBar::class);
    }

    /**
     * Apply filters
     *
     * @return void
     */
    public function applyFilters()
    {
        // $this->unsetPage();

        $this->dispatch('submitSearch', filters: $this->getFilters())
            ->to(MainSearchBar::class);
    }
}
