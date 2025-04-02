<div class="flex relative z-0 gap-2 p-1 max-h-full text-white border thick-border focus:outline-none focus:ring-0 focus:border-transparent"
    wire:click.outside="closeDropdown" wire:keydown.escape.prevent="closeDropdown"
    wire:keydown.backspace="removeLastTag" wire:keydown.cmd.shift.backspace.prevent="resetTags"
    wire:keydown.ctrl.shift.backspace.prevent="resetTags"
    x-on:keydown.enter.stop.prevent="$wire.submitSearch()"
    x-on:keydown.tab.stop.prevent="$dispatch('pushinputtoselected', [ $wire.input ])"
    wire:keydown.down.stop.prevent="nextTagByIndex" wire:keydown.up.stop.prevent="previousTagByIndex"
    >

    <div class="overflow-x-auto flex-1 cursor-text">
        <div class="flex flex-nowrap gap-1 items-center mr-3">

            @foreach($selected ?? [] as $index => $urlParameter)
            <x-tag.url-parameter :urlParameter="$urlParameter" wire:key="'urlparameter-' . $index" />
            @endforeach

            <input type="text" wire:model.live.debounce.100ms="input"
                class="flex-grow p-2 text-lg leading-none text-white bg-black border-none focus:ring-0 focus:outline-none text-nowrap"
                x-ref="MainInputSearch"
                />
        </div>
    </div>

    <!-- Tags List -->
    <div class="overflow-y-auto absolute left-0 top-full z-30 p-2 mt-1 w-full max-h-96 bg-black border border-white shadow-lg min-w-48"
        x-data="{ hoverIndex: @entangle('index'), showDropdown: @entangle('showDropdown') }"
        x-show="showDropdown"
        x-ref="MainDropdown"
        @scrollmaindropdownup.window="$refs.MainDropdown.scrollTop -= $refs['MainDropdownButton-' + hoverIndex ].offsetTop;"
        @scrollmaindropdowndown.window="$refs.MainDropdown.scrollTop += $refs['MainDropdownButton-' + hoverIndex ].offsetTop;"
        >

        @foreach($tags ?? [] as $index => $tag)
        <button type="button" wire:key="'tag-' . $index" class="w-full lg:p-3 rounded-lg text-left text-white hover:bg-red-900
            {{ $this->isSelected($index) ? 'bg-red-800/30' : '' }}"
            :class="{ '!bg-red-800': hoverIndex == {{ $index }} }"
            wire:click.prevent="$dispatch('toggletag', [{{ $index }}])"
            @mouseenter="hoverIndex = {{ $index }}"
            :class="{ 'bg-red-800': hoverIndex == {{ $index }} }"
            x-ref="MainDropdownButton-{{ $index }}"
            wire:key="'listbutton-' . $index"
            >

            <div class="flex items-center">
                @if($this->isSelected($index))
                <i class="mr-2 text-red-500 fas fa-check"></i>
                @endif
                <i class="pr-1 fas fa-tag"></i> {{ $tag->name }}
            </div>

        </button>
        @endforeach
    </div>

    <div class="flex-none">
        <button wire:click.prevent="submitSearch" class="px-6 py-2 text-white bg-red-800 rounded-md hover:bg-red-700">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>
