@props(['noTagIcon' => false])

<div class="bg-black movie-card">

    <a href="{{ route('movie.details', $movie->slug) }}" wire:navigate>
        <div class="relative movie-card-aspect">
            @if($movie->thumbBadge)
            <div class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                {{ $movie->thumbBadge }}
            </div>
            @endif

            <img src="{{ $movie->getFirstMediaUrl('images', 'thumbnail') }}" alt="{{ $movie->title }}"
                class="object-cover w-full h-full" />
        </div>
    </a>

    <div class="py-4">
        <a class="hover:underline" href="{{ route('movie.details', $movie->slug) }}" wire:navigate>
            <h3 class="mb-2 text-lg font-semibold text-white truncate">{{ $movie->title }}</h3>
        </a>
        <div class="flex items-center mb-2">
            <div class="flex text-yellow-500">
                @for($i = 1; $i <= 5; $i++) @if($i <=$movie->rating)
                    <i class="fas fa-star"></i>
                    @elseif($i - 0.5 <= $movie->rating)
                        <i class="fas fa-star-half-alt"></i>
                        @else
                        <i class="far fa-star"></i>
                        @endif
                        @endfor
            </div>
            {{-- <span class="ml-2 text-sm text-gray-400">{{ number_format($movie->rating, 1) }}/5</span> --}}
            <span class="mx-2 text-sm text-gray-400">•</span>
            <span class="gap-1 text-sm text-gray-400 font-size-1">
                @if($movie->firstGenre)
                <x-tag.tag :noicon="$noTagIcon" :tag="$movie->firstGenre" />
                @endif
                @if($movie->firstSubGenre)
                <x-tag.tag :noicon="$noTagIcon" :tag="$movie->firstSubGenre" />
                @endif
            </span>
        </div>
        <div class="text-sm text-gray-300 line-clamp-3">{!! $movie->description !!}</div>
    </div>
</div>