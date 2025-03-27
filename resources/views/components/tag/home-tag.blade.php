@props([
'content',
'type',
'id'
])

{{-- @dd($id, $content, $type) --}}

<button title="Remove tag" type="button"
    class="flex-none px-6 py-3 border border-gray-700 transition-colors duration-300 bg-gray-800/20 hover:bg-gray-800/30"
    wire:click="$dispatch('toggletagfromsite', { id: '{{ $id }}', content: '{{ $content }}', type: '{{ $type->value }}' })"
    wire:key="tag-{{ str_replace(' ', '', $content) }}">
    <div class="flex gap-2 items-center">
        {!! $type->getIcon() !!} {{ $content }}
    </div>
</button>