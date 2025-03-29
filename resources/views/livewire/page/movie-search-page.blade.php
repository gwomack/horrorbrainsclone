<div class="mx-auto lg:container">
    <section class="pb-6 bg-black border-b light-border">
        <div class="flex flex-col gap-4 p-4">
            {{-- <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-white">Advanced Filters</h3>
            </div> --}}


            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- Release Date Range -->
                <div class="space-y-2 col-span-4">
                    <label class="block text-sm font-medium text-gray-300">Release Date Range</label>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <input type="date" wire:model.live="filters.start_date"
                                class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        <div class="flex-1">
                            <input type="date" wire:model.live="filters.end_date"
                                class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Rating Filter -->
                <div class="space-y-2 col-span-2">
                    <label class="block text-sm font-medium text-gray-300">Minimum Rating</label>
                    <div class="flex items-center gap-2">
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
                    class="px-6 py-2 bg-red-800 text-white rounded-md hover:bg-red-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-black">
                    Apply Filters
                </button>
                <button wire:click="resetFilters"
                    class="text-sm text-gray-400 hover:text-white transition-colors duration-300">
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
            <x-movie-block :title="$movie['title']" :image="$movie['image']" :rating="$movie['rating']"
                :description="$movie['description']" :year="$movie['year']" :genre="$movie['genre']"
                :badge="$movie['badge']" />
            @endforeach
        </div>

        <!-- Pagination Controls -->
        @if($this->totalPages > 1)
        <div class="flex justify-center items-center mt-8 space-x-2 pt-8">
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