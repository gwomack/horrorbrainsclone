@php use App\Livewire\UrlParamType; @endphp

@section('title', $post->title)

<div class="container mx-auto min-h-screen lg:px-4 lg:pb-8">

    <!-- Movie Details Section -->
    <div class="grid grid-cols-1 gap-20 lg:grid-cols-4">

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">
                    {{ $post->title }}
                </h1>
            </div>

            <div class="mt-6">
                <!-- Hero Section with Movie Poster -->
                <livewire:photo-gallery :post="$post" />
            </div>

            <!-- Movie Info -->
            <div class="space-y-12">


                <div class="flex flex-wrap gap-6 items-center mb-8">

                    <livewire:post-rating :post="$post" />

                    <div class="flex items-center space-x-2">
                        <span class="text-gray-500">Release:</span>
                        <span class="text-gray-300">{{ $post->release_date->format('m/d/Y') }}</span>
                    </div>
                    @if($post->firstYear)
                    <x-tag.tag :tag="$post->firstYear" />
                    @endif
                </div>

                <!-- Synopsis -->
                <div class="">
                    {{-- <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Movie <span
                            class="blood-red">Synopsis</span></h2> --}}
                    <p class="leading-relaxed text-gray-300">
                        {!! $post->description !!}
                    </p>
                </div>

                <!-- Movie Tags -->
                <div class="space-y-1">
                    {{-- <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Movie <span
                            class="blood-red">Tags</span></h2> --}}

                    @if ($post->genre->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Genre:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->genre as $genre)
                            <x-tag.tag :tag="$genre" />
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->subgenre->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Subgenre:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->subgenre as $subgenre)
                            <x-tag.tag :tag="$subgenre" />
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->acting->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Acting:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->acting as $acting)
                            <div>
                                <x-tag.tag :tag="$acting" />
                                <p class="text-sm text-center text-gray-400 text-nowrap">
                                    <span class="italic">{{ $acting->pivot->custom['field'] ?? '' }}</span>
                                    {{ $acting->pivot->custom['value'] ?? '' }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->production->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Production:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->production as $production)
                            <x-tag.tag :tag="$production" />
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->distribution->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Distribution:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->distribution as $distribution)
                            <x-tag.tag :tag="$distribution" />
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->director->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Director:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->director as $director)
                            <x-tag.tag :tag="$director" />
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->writer->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Writer:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->writer as $writer)
                            <x-tag.tag :tag="$writer" />
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->country->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Country:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->country as $country)
                            <x-tag.tag :tag="$country" />
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($post->language->isNotEmpty())
                    <div class="flex gap-1 items-center">
                        <div class="flex-none w-24">
                            <span class="text-gray-500">Language:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                            @foreach ($post->language as $language)
                            <x-tag.tag :tag="$language" />
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                {{--
                <!-- External Resources -->
                <div class="">
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">External <span
                            class="blood-red">Resources</span></h2>
                    <div class="flex flex-wrap gap-1">
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-yellow-600 shadow-lg transition-all duration-300 hover:bg-yellow-500">
                            <i class="mr-3 text-xl fab fa-imdb"></i> IMDb
                        </a>
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-red-700 shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fas fa-tv"></i> Trakt.tv
                        </a>
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-gray-700 shadow-lg transition-all duration-300 hover:bg-gray-600">
                            <i class="mr-3 text-xl fab fa-wikipedia-w"></i> Wikipedia
                        </a>
                    </div>
                </div>

                <!-- Where to Watch -->
                <div class="">
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Where to <span
                            class="blood-red">Watch</span></h2>
                    <div class="flex flex-wrap gap-1">
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-red-700 shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fab fa-amazon"></i> Amazon Prime
                        </a>
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-red-700 shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fab fa-netflix"></i> Netflix
                        </a>
                    </div>
                </div> --}}

                <!-- User Reviews -->
                <x-comment :post="$post" />
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Similar Movies -->
            <div class="">
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">
                    Similar <span class="blood-red">Movies</span>
                </h2>
                <x-similar-posts :post="$post" />
            </div>
        </div>
    </div>
</div>