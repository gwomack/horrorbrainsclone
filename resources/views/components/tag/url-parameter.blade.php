
<button title="Toggle tag" type="button"
    wire:click.prevent="$dispatch('toggletag', [ '{{ $urlParameter['id'] }}' ])"
    class="px-3 py-2 text-sm text-white bg-gray-800 ring-0 text-nowrap hover:text-white focus:ring-0 focus:outline-none"
    >
    {!! $urlParameter['type']->getIcon() !!}
    {{ $urlParameter['name'] }}
</button>
