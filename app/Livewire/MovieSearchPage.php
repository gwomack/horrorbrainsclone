<?php

namespace App\Livewire;

use Livewire\Component;

class MovieSearchPage extends Component
{
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
     * Mount the component
     *
     * @return void
     */
    public function mount()
    {
        $this->selected = request()->all();
    }

    /**
     * Get the paginated movies
     *
     * @return array
     */
    public function getMoviesProperty()
    {
        // This is a placeholder array - replace with actual movie data from your database
        $movies = [];
        for ($i = 1; $i <= 50; $i++) {
            $movies[] = [
                'title' => "Mood Movie {$i}",
                'image' => 'https://m.media-amazon.com/images/M/MV5BNzM0OGZiZWItYmZiNC00NDgzLTg1MjMtYjM4MWZhOGZhMDUwXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg',
                'rating' => '4.5',
                'description' => 'A gripping horror story that will keep you on the edge of your seat.',
                'year' => '2024',
                'genre' => 'Horror/Thriller',
                'badge' => 'NEW',
            ];
        }

        $start = ($this->page - 1) * $this->perPage;

        return array_slice($movies, $start, $this->perPage);
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
        return view('livewire.page.movie-search-page');
    }
}
