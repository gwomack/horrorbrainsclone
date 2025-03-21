<div
    class="flex z-0 px-3 pt-3 pb-2 h-16 max-h-full text-white border thick-border focus:outline-none focus:ring-0 focus:border-transparent">
    <div class="overflow-auto flex-1 cursor-text scrollbar-hide">
        <div class="flex flex-nowrap gap-2 items-center mr-3">
            @foreach($selectedTags as $tag)
                <button title="Remove tag"
                    type="button"
                    wire:click="$dispatch('tagRemoved', [{{ $tag['id'] }}, '{{ $tag['content'] }}', '{{ $tag['type'] }}'])"
                    class="px-3 py-2 text-sm text-white rounded-md border border-gray-700 ring-0 text-nowrap hover:text-white focus:ring-0 focus:outline-none"
                    wire:key="tag-{{ str_replace(' ', '', $tag['content']) }}"
                    >@if($tag['type'] === 'tag') <i class="pr-1 fas fa-tag"></i>
                    @else <i class="pr-1 fas fa-italic"></i>
                    @endif {{ $tag['content'] }}
                </button>
            @endforeach

            <input type="text"
                wire:model="input"
                @keyup.escape="$dispatch('hideInput')"
                @keyup.enter="$dispatch('inputSelected')"
                {{-- @keyup.shift.enter="$dispatch('inputSelected')" --}}
                {{-- @keyup.tab="$dispatch('inputSelected')" --}}
                @blur="$dispatch('inputSelected')"
                {{-- x-data x-ref="inputtag" --}}
                {{-- x-click="$refs.inputtag.focus()" --}}
                class="flex-grow p-2 text-lg leading-none text-white bg-black border-none focus:ring-0 focus:outline-none text-nowrap" />
        </div>
    </div>

    <div class="flex-none">
        <button class="px-6 py-2 text-white bg-red-800 rounded-md hover:bg-red-700">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>