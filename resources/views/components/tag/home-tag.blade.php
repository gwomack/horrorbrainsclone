@php
use App\Models\Tag\TagType;
@endphp

@props([
'content',
'type',
'id'
])

<button title="Remove tag" type="button"
    class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30"
    wire:click="$dispatch('toggletag', [{{ $id }}, '{{ $content }}', '{{ $type }}'])" class=""
    wire:key="tag-{{ str_replace(' ', '', $content) }}">
    <div class="flex gap-2 items-center">
        {!! TagType::fromLabel($type)->getIcon() !!} {{ $content }}
    </div>
</button>