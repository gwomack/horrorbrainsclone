@props(['tag', 'showCount' => false])

<button title="Toggle tag" type="button"
    class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30"
    wire:click="$dispatch('toggletagfromsite', [ @js($tag->toArray()) ])"
    wire:key="'tag-' . $tag->getKey()">
    <div class="flex gap-2 items-center">
        {!! $tag->type->getIcon() !!} {{ $tag->name }}
    </div>
    @if ($showCount && isset($tag->posts_count) && $tag->posts_count > 0)
        <div class="flex gap-2 items-center text-gray-500" style="font-size: 0.8rem;">
            {{ $tag->posts_count }} {{ Str::plural('movie', $tag->posts_count) }}
        </div>
    @endif
</button>