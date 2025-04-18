<div class="flex items-center space-x-2">
    <div class="flex text-yellow-500">
        @for ($i = 1; $i < 6; $i++)
            <button type="button"
                wire:key="star-{{ $i }}"
                wire:click.prevent.stop="saveUserRating({{ $i }})"
                x-on:mouseover="event.target.style.color='yellow'"
                x-on:mouseout="event.target.style.color='#eab308'"
                class="star"
                @if (($avgRating - $i) >= 0.0)
                    <i class="fas fa-star"></i>
                @elseif (($avgRating - $i) < 0.0 && ($avgRating - $i) > -1.0)
                <i class="fas fa-star-half-alt"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            </button>
        @endfor
    </div>
    <span class="font-medium text-gray-300">{{ $avgRating }}/5</span>
    <span class="font-medium text-gray-600">({{ $ratingCount }} ratings)</span>
</div>