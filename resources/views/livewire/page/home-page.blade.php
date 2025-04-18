@section('title', 'Horror Movies')

@php
use App\Models\Post\Post;
use App\Livewire\UrlParamType;
use App\Livewire\MovieSearchPage\OrderByType;
use App\Livewire\MovieSearchPage\OrderDirectionType;
@endphp

<div class="px-4 mx-auto space-y-14 lg:container">

    <!-- Featured Tags Section -->
    <section class="pb-6 bg-black border-b light-border">
        <div class="flex overflow-x-auto gap-2 pb-2 scrollbar-hide">
            {{-- <a href="{{ route('movie.search', ['order_by' => OrderByType::TRENDING->value]) }}"
                class="flex-none px-6 py-3 border border-red-500 transition-colors duration-300 hover:bg-red-800/30">
                <div class="flex gap-2 items-center">
                    <i class="text-red-600 fas fa-fire"></i>
                    <span class="text-sm font-medium whitespace-nowrap">Trending Now</span>
                </div>
            </a>
            <a href="{{ route('movie.search', ['order_by' => OrderByType::RATING->value, 'order_direction' => OrderDirectionType::DESC->value]) }}"
                class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30">
                <div class="flex gap-2 items-center">
                    <i class="text-yellow-500 fas fa-star"></i>
                    <span class="text-sm font-medium whitespace-nowrap">Top Rated</span>
                </div>
            </a>
            <a href="{{ route('movie.search', ['start_date' => now()->format('Y-m-d')]) }}"
                class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30">
                <div class="flex gap-2 items-center">
                    <i class="text-gray-400 fas fa-calendar"></i>
                    <span class="text-sm font-medium whitespace-nowrap">Coming Soon</span>
                </div>
            </a> --}}

            @foreach ($subGenreTags as $tag)
                <x-tag.home-tag :tag="$tag" />
            @endforeach
        </div>
    </section>

    <!-- Latest Releases Section -->
    <section id="latest" class="bg-black">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Latest <span class="blood-red">Releases</span></h2>
            <a wire:navigate href="{{ route('movie.search') }}" class="flex items-center text-sm text-gray-400 hover:text-white">
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

    @foreach ($trendingHomePageTags as $thpTag)
        <section class="bg-black">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-white md:text-3xl">
                    {!! $this->getTrendingTitle($thpTag->name) !!}
                </h2>
                <a wire:click.prevent="$dispatch('addtagfromsite', { modelarray: @js($thpTag->toArray()), navigate: true })"
                    href="#"
                    class="flex items-center text-sm text-gray-400 hover:text-white"
                >View All <i class="ml-2 fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 gap-2 mb-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($thpTag->posts as $post)
                <x-movie.movie-block :movie="$post" />
            @endforeach
            </div>
        </section>
    @endforeach

    <!-- Random Tags Section -->
    <section class="bg-black">
        <h2 class="mb-8 text-2xl font-bold text-white md:text-3xl">Random <span class="blood-red">Tags</span></h2>

        <div class="grid grid-cols-2 gap-2 md:grid-cols-4">
            @foreach ($randomTags as $tag)
                <x-tag.home-tag :tag="$tag" :showCount="true" />
            @endforeach
        </div>
    </section>

</div>
