
<button title="Remove tag" type="button"
    wire:click="$dispatch('toggletagfromsite', [ @js($tag->toArray()) ])"
    class="px-3 py-2 text-sm text-white bg-gray-800 ring-0 text-nowrap hover:text-white focus:ring-0 focus:outline-none"
    wire:key="'tag-' . $tag->getKey()">
    {!! $tag->getType()->getIcon() !!}
    {{ $tag->name }}
</button>