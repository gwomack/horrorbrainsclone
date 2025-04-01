@props(['urlParameter'])

<button title="Remove tag" type="button"
    wire:click="toggleTag({{ $urlParameter['id'] }})"
    class="px-3 py-2 text-sm text-white bg-gray-800 rounded-full ring-0 text-nowrap hover:text-white focus:ring-0 focus:outline-none"
    wire:key="'tag-' . {{ $urlParameter['id'] }}">
    {!! $urlParameter['type']->getIcon() !!}
    {{ $urlParameter['name'] }}
</button>
