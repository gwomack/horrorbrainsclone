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
            @foreach ($subGenreTags as $tag)
            <x-tag.home-tag :tag="$tag" />
            @endforeach
        </div>
    </section>

    <!-- Latest Releases Section -->
    <section id="latest" class="bg-black">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white md:text-3xl">Latest <span class="blood-red">Releases</span></h2>
            <a wire:navigate href="{{ route('movie.search') }}"
                class="flex items-center text-sm text-gray-400 hover:text-white">
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
                href="#" class="flex items-center text-sm text-gray-400 hover:text-white">View All <i
                    class="ml-2 fas fa-arrow-right"></i>
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
        <h2 class="mb-8 text-2xl font-bold text-white md:text-3xl">Random <span class="blood-red">Sub Genres</span></h2>

        <div class="grid grid-cols-2 gap-2 md:grid-cols-4">
            @foreach ($randomTags as $tag)
            <x-tag.home-tag :tag="$tag" :showCount="true" />
            @endforeach
        </div>
    </section>

</div>