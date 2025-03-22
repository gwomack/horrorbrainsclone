<div
    class="flex z-0 gap-2 px-3 pt-3 pb-2 h-16 max-h-full text-white border thick-border focus:outline-none focus:ring-0 focus:border-transparent">

    {{-- <div class="flex-none"> --}}
        {{-- <button class="px-6 py-2 text-white bg-gray-900 rounded-md hover:bg-gray-800" title="Select Tags"><i
                class="fas fa-tag"></i>
        </button> --}}
        {{-- </div> --}}


    <div class="overflow-auto flex-1 cursor-text scrollbar-hide">
        <div class="flex flex-nowrap items-center mr-3 gap-2">

            @foreach($selectedTags as $tag)
            <x-tag.tag :id="$tag['id']" :content="$tag['content']" :type="$tag['type']" />
            @endforeach

            <input type="text" wire:model.live.debounce.100ms="input" wire:keydown.escape.prevent="closeDropdown"
                class="flex-grow p-2 text-lg leading-none text-white bg-black border-none focus:ring-0 focus:outline-none text-nowrap"
                x-ref="MainInputSearch" wire:keyup.enter.prevent="submitSearch"
                wire:keydown.tab.prevent="$dispatch('inputSelected')" wire:keydown.backspace="removeLastTag"
                wire:keydown.cmd.shift.backspace.prevent="clearTags"
                wire:keydown.ctrl.shift.backspace.prevent="clearTags" />
        </div>
    </div>

    <!-- Tags List -->
    @if ($showDropdown)
    <div class="absolute top-16 left-0 w-full z-50 mt-1 bg-gray-800 shadow-lg min-w-48 max-h-96 overflow-y-auto focus:outline-1 focus:outline-red-500"
        wire:click.outside="closeDropdown" x-init="$refs.mainSearchBarDropdown.focus()" x-ref="mainSearchBarDropdown">
        <div class="overflow-y-auto">
            @foreach($filteredTags as $tag)
            <button type="button"
                class="w-full focus:outline-1 focus:border-red-500 px-4 py-2 text-left text-white  {{ in_array($tag, $selectedTags) ? 'bg-red-900/30' : '' }}"
                wire:key="tag-{{ $tag['id'] . rand(1, 1000) }}"
                wire:click="$dispatch('toggleTag', [{{ $tag['id'] }}, '{{ $tag['content'] }}', '{{ $tag['type'] }}']);"
                @click="$refs.MainInputSearch.focus()">

                <div class="flex items-center">
                    @if(in_array($tag, $selectedTags))
                    <i class="mr-2 text-red-500 fas fa-check"></i>
                    @endif
                    <i class="pr-1 fas fa-tag"></i> {{ $tag['content'] }}
                </div>

            </button>
            @endforeach
        </div>
    </div>
    @endif

    <div class="flex-none">
        <button wire:click.prevent="submitSearch" class="px-6 py-2 text-white bg-red-800 rounded-md hover:bg-red-700">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>