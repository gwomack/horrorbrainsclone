@props(['tag'])

<button title="Remove tag" type="button"
    class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30"
    wire:click="$dispatch('toggletagfromsite', { id: '{{ $tag->getKey() }}', content: '{{ $tag->name }}', type: '{{ $tag->type }}' })"
    wire:key="tag-{{ str_replace(' ', '', $tag->name) }}">
    <div class="flex gap-2 items-center">
        {!! $tag->type->getIcon() !!} {{ $tag->name }}
    </div>
</button>