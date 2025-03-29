@section('title', 'Horror Movies')

@php
use App\Livewire\UrlParamType;
use App\Models\Post\Post;
@endphp

<div class="px-4 mx-auto lg:container">

    <!-- Featured Tags Section -->
    <section class="pb-6 bg-black border-b light-border">
        <div class="flex overflow-x-auto gap-2 pb-2 scrollbar-hide">
            <a href=""
                class="flex-none px-6 py-3 border border-red-800 transition-colors duration-300 bg-red-800/20 hover:bg-red-800/30">
                <div class="flex gap-2 items-center">
                    <i class="text-red-600 fas fa-fire"></i>
                    <span class="text-sm font-medium whitespace-nowrap">Trending Now</span>
                </div>
            </a>
            <a href=""
                class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30">
                <div class="flex gap-2 items-center">
                    <i class="text-yellow-500 fas fa-star"></i>
                    <span class="text-sm font-medium whitespace-nowrap">Top Rated</span>
                </div>
            </a>
            <a href=""
                class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30">
                <div class="flex gap-2 items-center">
                    <i class="text-gray-400 fas fa-calendar"></i>
                    <span class="text-sm font-medium whitespace-nowrap">Coming Soon</span>
                </div>
            </a>

            @foreach ($subGenreTags as $tag)
                <x-tag.home-tag :tag="$tag" />
            @endforeach
        </div>
    </section>

    <!-- Latest Releases Section -->
    <section id="latest" class="py-12 bg-black">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Latest <span class="blood-red">Releases</span></h2>
            <a href="#" class="flex items-center text-sm text-gray-400 hover:text-white">
                View All <i class="ml-2 fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- First Row - 2 Large Squares -->
        <div class="grid grid-cols-2 gap-2 mb-2 md:grid-cols-3">

            @foreach ($latestReleases as $latestRelease)
                <x-movie.movie-block :movie="$latestRelease" />
            @endforeach
        </div>

    </section>

    <!-- Mood-Based Tags Section -->
    <section class="py-12 bg-black">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Disturbing <span class="blood-red">&
                    Unsettling</span></h2>
            <a href="#" class="flex items-center text-sm text-gray-400 hover:text-white">
                View All <i class="ml-2 fas fa-arrow-right"></i>
            </a>
        </div>
        <!-- Two rows of movie blocks -->
        <div class="grid grid-cols-2 gap-2 mb-2 md:grid-cols-3 lg:grid-cols-4">
                @for ($j = 1; $j <= 6; $j++)
                    <x-movie.movie-block :movie="new Post([
                        'id' => $j,
                        'title' => 'Mood Movie ' . $j,
                        'rating' => 4.5,
                        'description' => 'A gripping horror story that will keep you on the edge of your seat.',
                        'year' => '2024',
                        'genre' => 'Horror/Thriller',
                        'thumbBadge' => 'NEW'
                    ])" />
            @endfor
        </div>

        <!-- Specific Situations Section -->
        <div class="grid grid-cols-2 gap-2 mb-2 md:grid-cols-3 lg:grid-cols-4">
            @for ($j = 1; $j <= 6; $j++)
                <x-movie.movie-block :movie="new Post([
                    'id' => $j,
                    'title' => 'Situation Movie ' . $j,
                    'rating' => 4.5,
                    'description' => 'A gripping horror story that will keep you on the edge of your seat.',
                    'year' => '2024',
                    'genre' => 'Horror/Thriller',
                    'thumbBadge' => 'NEW'
                ])" />
            @endfor
        </div>
    </section>

    <!-- Unique Themes Section -->
    <section class="py-12 bg-black">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Retro Horror <span class="blood-red">Classics</span>
            </h2>
            <a href="#" class="flex items-center text-sm text-gray-400 hover:text-white">
                View All <i class="ml-2 fas fa-arrow-right"></i>
            </a>
        </div>
        <!-- Two rows of movie blocks -->
        <div class="grid grid-cols-2 gap-2 mb-2 md:grid-cols-3 lg:grid-cols-4">
            @for ($j = 1; $j <= 6; $j++)
                <x-movie.movie-block :movie="new Post([
                    'id' => $j,
                    'title' => 'Theme Movie ' . $j,
                    'rating' => 4.5,
                    'description' => 'A gripping horror story that will keep you on the edge of your seat.',
                    'year' => '2024',
                    'genre' => 'Horror/Thriller',
                    'thumbBadge' => 'NEW'
                ])" />
            @endfor
        </div>
    </section>

    <!-- Specific Situations Section -->
    <section class="py-12 bg-black">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Small Town <span class="blood-red">Terrors</span>
            </h2>
            <a href="#" class="flex items-center text-sm text-gray-400 hover:text-white">
                View All <i class="ml-2 fas fa-arrow-right"></i>
            </a>
        </div>
        <!-- Two rows of movie blocks -->
        <div class="grid grid-cols-2 gap-2 mb-2 md:grid-cols-3 lg:grid-cols-4">
            @for ($j = 1; $j <= 6; $j++)
                <x-movie.movie-block :movie="new Post([
                    'id' => $j,
                    'title' => 'Situation Movie ' . $j,
                    'rating' => 4.5,
                    'description' => 'A gripping horror story that will keep you on the edge of your seat.',
                    'year' => '2024',
                    'genre' => 'Horror/Thriller',
                    'thumbBadge' => 'NEW'
                ])" />
            @endfor
        </div>
    </section>

    <!-- Pagination -->
    {{-- <div class="flex justify-center items-center mt-8 space-x-2">
        <a href="#" class="px-4 py-2 text-sm text-gray-400 bg-gray-800 rounded-md hover:bg-gray-700">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a href="#" class="px-4 py-2 text-sm text-white bg-red-800 rounded-md">1</a>
        <a href="#" class="px-4 py-2 text-sm text-gray-400 bg-gray-800 rounded-md hover:bg-gray-700">2</a>
        <a href="#" class="px-4 py-2 text-sm text-gray-400 bg-gray-800 rounded-md hover:bg-gray-700">3</a>
        <span class="px-4 py-2 text-sm text-gray-400">...</span>
        <a href="#" class="px-4 py-2 text-sm text-gray-400 bg-gray-800 rounded-md hover:bg-gray-700">10</a>
        <a href="#" class="px-4 py-2 text-sm text-gray-400 bg-gray-800 rounded-md hover:bg-gray-700">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div> --}}

    <!-- Categories Section -->
    <section class="py-12">
        <div class="px-4">
            <h2 class="mb-8 text-2xl font-bold text-white md:text-3xl">Browse by <span class="blood-red">Category</span>
            </h2>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <!-- Category 1 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1509248961158-e54f6934749c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Slasher"
                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Slasher</h3>
                        <p class="text-xs text-gray-300">42 movies</p>
                    </div>
                </a>

                <!-- Category 2 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Supernatural"
                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Supernatural</h3>
                        <p class="text-xs text-gray-300">38 movies</p>
                    </div>
                </a>

                <!-- Category 3 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1603720999656-f4f9d7c2c75e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Psychological"
                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Psychological</h3>
                        <p class="text-xs text-gray-300">29 movies</p>
                    </div>
                </a>

                <!-- Category 4 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Found Footage"
                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Found Footage</h3>
                        <p class="text-xs text-gray-300">17 movies</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

</div>
