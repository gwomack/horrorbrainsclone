<div class="px-4 mx-auto lg:container" @movie-search-page-refresh="$wire.$refresh()">
    <section class="pb-6 mx-auto max-w-3xl bg-black">
        <div class="flex flex-col flex-wrap gap-2">
            {{-- <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-white">Advanced Filters</h3>
            </div> --}}


            <div class="flex gap-4">
                <!-- Release Date Range -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300">Release Date Range</label>
                    <div class="flex gap-1">
                        <div class="flex-1">
                            <input type="date" wire:model="filters.start_date"
                                class="px-4 py-2 w-full text-white bg-gray-800 border-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        <div class="flex-1">
                            <input type="date" wire:model="filters.end_date"
                                class="px-4 py-2 w-full text-white bg-gray-800 border-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Sorting</label>

                        <div class="flex gap-1">
                            <div class="flex-1">
                                <select wire:model="filters.order_by"
                                    class="px-4 py-2 w-full text-white bg-gray-800 border-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    @foreach ($orderByTypes as $orderByType)
                                    <option value="{{ $orderByType['id'] }}" {{
                                        $orderByType['id']===($filters['order_by'] ?? 'release_date' ) ? 'selected' : ''
                                        }}>{{ $orderByType['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1">
                                <select wire:model="filters.order_direction"
                                    class="px-4 py-2 w-full text-white bg-gray-800 border-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    @foreach ($orderDirectionTypes as $orderDirectionType)
                                    <option value="{{ $orderDirectionType['id'] }}">
                                        {{ $orderDirectionType['label'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Filter -->
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-300">Minimum Rating</label>
                    <x-filter-rating :rating="$filters['rating'] ?? null" />
                </div>

                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-300">Search Type</label>
                    <div class="flex gap-x-3 items-center">
                        <label for="hs-basic-with-description"
                            class="text-sm text-gray-500 dark:text-neutral-400">OR</label>
                        <label for="hs-basic-with-description" class="inline-block relative w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="hs-basic-with-description" class="sr-only peer"
                                wire:model="filters.st" {{ ($filters['st'] ?? false) ? 'checked' : '' }}>
                            <span
                                class="absolute inset-0 bg-gray-800 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-blue-600 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                            <span
                                class="absolute top-1/2 bg-white rounded-full transition-transform duration-200 ease-in-out -translate-y-1/2 start-0.5 size-5 shadow-xs peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                        </label>
                        <label for="hs-basic-with-description"
                            class="text-sm text-gray-500 dark:text-neutral-400">AND</label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <button wire:click="resetAll"
                    class="px-6 py-2 text-sm text-gray-400 bg-gray-800 transition-colors duration-300 hover:text-white">
                    Reset Filters
                </button>
                <button wire:click="applyFilters"
                    class="px-6 py-2 text-white transition-colors duration-300 blood-red-bg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-black">
                    Apply Filters
                </button>
            </div>
        </div>
    </section>

    <section class="py-12 bg-black border-t light-border">
        {{-- <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Results</h2>
        </div> --}}

        <!-- Two rows of movie blocks -->
        <div class="grid grid-cols-2 gap-x-2 gap-y-8 mb-2 md:grid-cols-3">
            @foreach ($movies as $movie)
            <x-movie.movie-block :movie="$movie" />
            @endforeach
        </div>

        <!-- Pagination Controls -->

        <div class="flex justify-center items-center pt-8 mt-8 space-x-2">
            {{ $movies->links() }}
        </div>

    </section>
</div>