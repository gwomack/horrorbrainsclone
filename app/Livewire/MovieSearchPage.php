<?php

namespace App\Livewire;

use App\Livewire\MainSearchBar\SearchUrlParameters;
use App\Models\Post\Post;
use Livewire\Component;
use Livewire\WithPagination;

class MovieSearchPage extends Component
{
    use WithPagination;

    /**
     * Filter properties
     *
     * @var array
     */
    public $filters = [
        'start_date' => '',
        'end_date' => '',
        'rating' => 0,
    ];

    /**
     * The URL parameters handler
     */
    protected SearchUrlParameters $urlHandler;

    /**
     * The current page number
     *
     * @var int
     */
    public $page = 1;

    /**
     * Number of items per page
     *
     * @var int
     */
    public $perPage = 12;

    /**
     * Get the paginated movies
     *
     * @return array
     */
    public function getMovies()
    {
        // This is a placeholder array - replace with actual movie data from your database
        $movies = collect();

        $movies = Post::query()
            ->with(['year', 'genre'])
            ->when($this->filters['start_date'], function ($query) {
                $query->where('release_date', '>=', $this->filters['start_date']);
            })
            ->when($this->filters['end_date'], function ($query) {
                $query->where('release_date', '<=', $this->filters['end_date']);
            })
            ->when($this->filters['rating'], function ($query) {
                $query->where('rating', '>=', $this->filters['rating']);
            })->when(isset($this->filters['tag']), function ($query) {
                $query->whereHas('tags', function ($query) {
                    $tagIds = $this->filters['tag'];
                    $query->whereIn('tags.id', $tagIds);
                });
            })->when(isset($this->filters['input']), function ($query) {
                foreach ($this->filters['input'] as $input) {
                    $query->where('title', 'like', '%'.$input.'%')
                        ->orWhere('description', 'like', '%'.$input.'%');
                }
            })->orderBy('release_date', 'desc')
            ->paginate($this->perPage);

        return $movies;
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
        $this->filters = array_merge($this->filters, $params);
    }

    /**
     * Apply filters
     *
     * @return void
     */
    public function applyFilters()
    {
        $this->page = 1; // Reset to first page when applying filters
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
        ];
        $this->page = 1;
    }

    /**
     * Render the component
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->buildFiltersFromRequest();

        return view('livewire.page.movie-search-page', [
            'movies' => $this->getMovies(),
        ]);
    }
}
