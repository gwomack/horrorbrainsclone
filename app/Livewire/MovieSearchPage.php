<?php

namespace App\Livewire;

use App\Livewire\MainSearchBar\MainSearchBar;
use App\Livewire\MainSearchBar\SearchUrlParameters;
use App\Models\Post\Post;
use Illuminate\Support\Facades\Log;
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
     * @var array
     */
    public $filters = [
        'start_date' => '',
        'end_date' => '',
        'rating' => 0,
        'page' => self::DEFAULT_PAGE,
        'perPage' => self::PER_PAGE,
    ];

    public $tag = [];

    public $input = [];

    protected $query;

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
        return Post::query()->with(['year', 'genre', 'media']);
    }

    /**
     * Get the filters query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getFiltersQuery()
    {
        return $this->query
            ->when($this->filters['end_date'], function ($query) {
                $query->where('release_date', '<=', $this->filters['end_date']);
            })
            ->when($this->filters['rating'], function ($query) {
                $query->where('rating', '>=', $this->filters['rating']);
            })->when(! empty($this->filters['tag']), function ($query) {
                $query->whereHas('tags', function ($query) {
                    $tagIds = $this->filters['tag'];
                    $query->whereIn('tags.id', $tagIds);
                });
            })->when(! empty($this->filters['input']), function ($query) {
                $input = $this->filters['input'];
                foreach ($input as $key => $value) {
                    $query->where('title', 'like', '%'.$value.'%')
                        ->orWhere('description', 'like', '%'.$value.'%');
                }
            });
    }

    /**
     * Boot the component
     *
     * @return void
     */
    public function boot()
    {
        $this->query = $this->getMoviesQuery();
    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount()
    {
        $this->buildFiltersFromRequest();
        $this->query = $this->getFiltersQuery();
    }

    /**
     * Build the selected tags from the request
     *
     * @param  Request|null  $request
     * @return void
     */
    public function buildFiltersFromRequest($request = null)
    {
        $this->urlHandler = new SearchUrlParameters;
        $params = $this->urlHandler->getFromRequest($request ?? request());
        $this->tag = $params[UrlParamType::TAG->value] ?? [];
        $this->input = $params[UrlParamType::INPUT->value] ?? [];
        $this->filters = collect($this->filters)
            ->replace(collect($params))->except('tag', 'input')
            ->toArray();
        Log::info($this->filters);
    }

    /**
     * Apply filters
     *
     * @return void
     */
    public function applyFilters()
    {
        $this->resetPage();
        $this->dispatch('submitSearch', filters: $this->filters)
            ->to(MainSearchBar::class);
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
     * Reset filters
     *
     * @return void
     */
    public function resetFilters()
    {
        $this->filters = [
            'start_date' => '',
            'end_date' => '',
            'rating' => 0,
            'tag' => [],
            'input' => [],
            'page' => self::DEFAULT_PAGE,
            'perPage' => self::PER_PAGE,
        ];
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
            'movies' => $this->query->orderBy('release_date', 'desc')->paginate($this->filters['perPage']),
        ]);
    }
}
