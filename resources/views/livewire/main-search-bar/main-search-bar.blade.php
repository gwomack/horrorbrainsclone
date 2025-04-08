<div class="relative"
wire:click.outside="closeDropdown" wire:keydown.escape.prevent="closeDropdown"
wire:keydown.backspace="removeLastTag" wire:keydown.cmd.shift.backspace.prevent="resetTags"
wire:keydown.ctrl.shift.backspace.prevent="resetTags"
x-on:keydown.enter.stop.prevent="$wire.submitSearch()"
x-on:keydown.tab.stop.prevent="$dispatch('pushinputtoselected', [ $wire.input ])"
wire:keydown.down.stop.prevent="nextTagByIndex" wire:keydown.up.stop.prevent="previousTagByIndex"
@main-searchbar-refresh="$wire.$refresh()"
>

<div class="flex relative z-0 flex-grow gap-x-1 gap-y-2 p-1 w-full text-white border thick-border focus:outline-none focus:ring-0 focus:border-transparent">

    <div class="overflow-x-auto flex-1 w-full cursor-text">

        <div class="flex flex-nowrap gap-1 items-center">

            @foreach($selected ?? [] as $index => $urlParameter)
            <x-tag.url-parameter :urlParameter="$urlParameter" wire:key="'urlparameter-' . $index" />
            @endforeach

            <input type="text" wire:model.live.debounce.200ms="input"
                class="flex-grow p-2 text-lg leading-none text-white bg-black border-none focus:ring-0 focus:outline-none text-nowrap"
                x-ref="MainInputSearch"
                />
        </div>
    </div>

    <!-- Tags List -->
    <div class="overflow-y-auto absolute left-0 top-full z-30 p-2 mt-1 w-full max-h-96 bg-black border border-white shadow-lg"
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
        <button wire:click.prevent="submitSearch" class="px-4 py-2 text-white blood-red hover:text-white hover:bg-red-700">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>

<div class="absolute top-0 w-10 grow-0" style="font-size: 0.8rem; right: -40px;">
    <button title="Clear Tags" wire:click.prevent="resetAll" class="px-3 py-4 text-white">
        <i class="fas fa-xmark"></i>
    </button>
</div>

</div>