<div class="bg-black movie-card">
    <div class="relative movie-card-aspect">
        @if($movie->thumbBadge)
            <div  class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                {{ $movie->thumbBadge }}
            </div>
        @endif
        <div class="absolute bottom-0 left-0 p-4 w-full">
            <h3 class="mb-2 text-lg font-semibold text-white">{{ $movie->title }}</h3>
            <div class="flex items-center mb-2">
                <div class="flex text-yellow-500">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $movie->rating)
                            <i class="fas fa-star"></i>
                        @elseif($i - 0.5 <= $movie->rating)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="ml-2 text-sm text-gray-400">{{ number_format($movie->rating, 1) }}/5</span>
            </div>

            <p class="hidden text-sm text-gray-300 lg:block">{!! $movie->description !!}</p>

            <div class="flex justify-between items-center mt-3">
                <span class="text-xs text-gray-400">{{ $movie->year }} • {{ $movie->genre }}</span>
            </div>

        </div>

        <a href="{{ route('movie.details', $movie->slug) }}" wire:navigate>
            <img src="{{ $movie->getFirstMediaUrl('images', 'thumbnail') }}" alt="{{ $movie->title }}" class="object-cover w-full h-full">
        </a>

    </div>
</div>
