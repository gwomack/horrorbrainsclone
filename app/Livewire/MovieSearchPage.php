<?php

namespace App\Livewire;

use App\Models\Post\Post;
use Livewire\Component;
use Livewire\WithPagination;

class MovieSearchPage extends Component
{
    use WithPagination;

    /**
     * The selected tags
     *
     * @var array|null
     */
    public $selected;

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
            })->when(isset($this->selected[UrlParamType::TAG->value]), function ($query) {
                $query->whereHas('tags', function ($query) {
                    $tagIds = $this->selected[UrlParamType::TAG->value];
                    $query->whereIn('tags.id', $tagIds);
                });
            })->when(isset($this->selected[UrlParamType::INPUT->value]), function ($query) {
                $input = $this->selected[UrlParamType::INPUT->value];
                $query->where('title', 'like', '%'.$input.'%')
                    ->orWhere('description', 'like', '%'.$input.'%');
            })->paginate($this->perPage);

        return $movies;
    }

    /**
     * Get the total number of pages
     *
     * @return int
     */
    public function getTotalPagesProperty()
    {
        // This is a placeholder - replace with actual total count from your database
        return ceil(50 / $this->perPage);
    }

    /**
     * Go to the next page
     *
     * @return void
     */
    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
        }
    }

    /**
     * Go to the previous page
     *
     * @return void
     */
    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    /**
     * Go to a specific page
     *
     * @param  int  $page
     * @return void
     */
    public function goToPage($page)
    {
        if ($page >= 1 && $page <= $this->totalPages) {
            $this->page = $page;
        }
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
        return view('livewire.page.movie-search-page', [
            'movies' => $this->getMovies(),
        ]);
    }
}
