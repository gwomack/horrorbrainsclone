<div class="flex z-0 gap-2 px-3 pt-3 pb-2 h-16 max-h-full text-white border thick-border focus:outline-none focus:ring-0 focus:border-transparent"
    wire:click.outside="closeDropdown">

    <div class="overflow-auto flex-1 cursor-text">
        <div class="flex flex-nowrap items-center mr-3 gap-2">

            @foreach($selected as $index => $tag)
            <x-tag.tag :id="$index" :content="$tag['content']" :type="$tag['type']" />
            @endforeach

            <input type="text" wire:model.live.debounce.100ms="input"
                class="flex-grow p-2 text-lg leading-none text-white bg-black border-none focus:ring-0 focus:outline-none text-nowrap"
                x-ref="MainInputSearch"
                @toggletag.window="$refs.MainInputSearch.scrollIntoView({ behavior: 'smooth', block: 'center' });"
                @toggletagbyindex.window="$refs.MainInputSearch.scrollIntoView({ behavior: 'smooth', block: 'center' });"
                wire:keydown.escape.prevent="closeDropdown" wire:keydown.backspace="removeLastTag"
                wire:keydown.cmd.shift.backspace.prevent="clearTags"
                wire:keydown.ctrl.shift.backspace.prevent="clearTags"
                x-on:keydown.enter.stop.prevent="$wire.showDropdown ? $dispatch('toggletagbyindex') : $wire.submitSearch()"
                x-on:keydown.tab.stop.prevent="$wire.showDropdown ? $dispatch('toggletagbyindex') : $dispatch('inputSelected')"
                wire:keydown.down.stop.prevent="nextTagByIndex" wire:keydown.up.stop.prevent="previousTagByIndex" />
        </div>
    </div>

    <!-- Tags List -->
    @if ($showDropdown)
    <div
        class="absolute border border-white top-16 left-0 w-full z-50 mt-1 bg-black shadow-lg min-w-48 max-h-96 overflow-y-auto p-2">
        @foreach($tags as $index => $tag)
        <button type=" button" wire:key="tag-{{ $index }}" class="w-full lg:p-3 rounded-lg text-left text-white hover:bg-red-900
            {{ $this->isSelected($index) ? 'bg-red-800/30' : '' }}
            {{ $this->isOnIndex($index) ? 'bg-red-800' : '' }}"
            wire:click.prevent="$dispatch('toggletag', [{{ $index }}])" @mouseenter="$wire.setIndex({{ $index }})">

            <div class="flex items-center">
                @if($this->isSelected($index))
                <i class="mr-2 text-red-500 fas fa-check"></i>
                @endif
                <i class="pr-1 fas fa-tag"></i> {{ $tag['content'] }}
            </div>

        </button>
        @endforeach
    </div>
    @endif

    <div class="flex-none">
        <button wire:click.prevent="submitSearch" class="px-6 py-2 text-white bg-red-800 rounded-md hover:bg-red-700">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>