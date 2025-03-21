<div class="relative">
    <!-- Selected Tags -->
    <div
        class="flex z-0 p-3 h-16 max-h-full text-white border thick-border focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-transparent">
        <div class="overflow-x-auto z-10 flex-1 cursor-text scrollbar-hide" x-data x-click="$refs.inputtag.focus()">
            <div class="flex flex-nowrap gap-2 items-center mr-3">
                @foreach($selectedTags as $tag)
                    <button title="Remove tag"
                        type="button"
                        wire:click="$dispatch('tagRemoved', ['{{ $tag }}'])"
                        class="px-3 py-2 text-sm text-white rounded-md border border-gray-700 text-nowrap hover:text-white ring-none"
                        wire:key="tag-{{ str_replace(' ', '', $tag) }}"
                        >{{ $tag }}
                    </button>
                @endforeach

                <input type="text"
                    wire:model="input"
                    @keyup.escape="$dispatch('hideInput')"
                    @keyup.enter="$dispatch('inputSelected')"
                    {{-- @keyup.shift.enter="$dispatch('inputSelected')" --}}
                    {{-- @keyup.tab="$dispatch('inputSelected')" --}}
                    @blur="$dispatch('inputSelected')"
                    x-data x-ref="inputtag" @inputSelected="$refs.inputtag.focus()"
                    class="z-10 flex-grow text-lg leading-none text-white bg-black border-none focus:ring-0 focus:outline-none text-nowrap" />
            </div>
        </div>

        <div class="flex-none">
            <button class="px-6 py-2 text-white bg-red-800 rounded-md hover:bg-red-700">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>