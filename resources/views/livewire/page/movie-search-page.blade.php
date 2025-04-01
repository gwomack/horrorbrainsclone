<div class="mx-auto lg:container">
    <section class="pb-6 bg-black border-b light-border">
        <div class="flex flex-col gap-4 p-4">
            {{-- <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-white">Advanced Filters</h3>
            </div> --}}


            <div class="grid grid-cols-1 gap-8 md:grid-cols-12">
                <!-- Release Date Range -->
                <div class="col-span-4 space-y-2">
                    <label class="block text-sm font-medium text-gray-300">Release Date Range</label>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <input type="date" wire:model.live="filters.start_date"
                                class="px-4 py-2 w-full text-white bg-gray-800 rounded-md border border-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        <div class="flex-1">
                            <input type="date" wire:model.live="filters.end_date"
                                class="px-4 py-2 w-full text-white bg-gray-800 rounded-md border border-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Rating Filter -->
                <div class="col-span-2 space-y-2">
                    <label class="block text-sm font-medium text-gray-300">Minimum Rating</label>
                    <div class="flex gap-2 items-center">
                        @for($i = 1; $i <= 5; $i++) <button wire:click="$set('filters.rating', {{ $i }})"
                            class="text-2xl focus:outline-none transition-colors duration-300 {{ $filters['rating'] >= $i ? 'text-yellow-500' : 'text-gray-600' }}">
                            ★
                            </button>
                            @endfor
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <button wire:click="applyFilters"
                    class="px-6 py-2 text-white bg-red-800 rounded-md transition-colors duration-300 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-black">
                    Apply Filters
                </button>
                <button wire:click="resetFilters"
                    class="text-sm text-gray-400 transition-colors duration-300 hover:text-white">
                    Reset Filters
                </button>
            </div>
        </div>
    </section>

    <section class="py-12 bg-black">
        {{-- <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Results</h2>
        </div> --}}

        <!-- Two rows of movie blocks -->
        <div class="grid grid-cols-2 gap-2 mb-2 md:grid-cols-3">
            @foreach ($this->movies as $movie)
            <x-movie.movie-block :movie="$movie" />
            @endforeach
        </div>

        <!-- Pagination Controls -->
        @if($this->totalPages > 1)
        <div class="flex justify-center items-center pt-8 mt-8 space-x-2">
            <button wire:click="previousPage"
                class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-50"
                @if($this->page <= 1) disabled @endif>
                    Previous
            </button>

            @for($i = 1; $i <= $this->totalPages; $i++)
                <button wire:click="goToPage({{ $i }})"
                    class="px-4 py-2 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 {{ $this->page === $i ? 'bg-white text-black' : 'text-white bg-gray-800 hover:bg-gray-700' }}">
                    {{ $i }}
                </button>
                @endfor

                <button wire:click="nextPage"
                    class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-50"
                    @if($this->page >= $this->totalPages) disabled @endif>
                    Next
                </button>
        </div>
        @endif
    </section>
</div>