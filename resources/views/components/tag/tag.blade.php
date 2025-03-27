@props([
'content',
'type',
'id'
])

<button title="Remove tag" type="button"
    wire:click="$dispatch('toggletagfromsite', ['{{ $id }}', '{{ $content }}', '{{ $type }}'])"
    class="px-3 py-2 text-sm text-white bg-gray-800 rounded-full ring-0 text-nowrap hover:text-white focus:ring-0 focus:outline-none"
    wire:key="tag-{{ str_replace(' ', '', $content) }}">
    {!! $type->getIcon() !!} {{ $content }}
</button>