<div>

    <!-- Dropdown Content -->
    @if($showDropdown)
    <div class="absolute z-50 mt-1 bg-gray-800 shadow-lg min-w-48" @click.outside="$dispatch('closeDropdown')">
        <!-- Search Input -->
        <div class="p-2 border-b border-gray-700">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search tags..."
                class="px-3 py-2 w-full text-white bg-gray-900 rounded-lg border border-gray-700 focus:outline-none focus:ring-2 focus:ring-white">
        </div>

        <!-- Tags List -->
        <div class="overflow-y-auto max-h-48">
            @foreach($filteredTags as $tag)
            <button type="button"
                wire:click="$dispatch('toggletag', [{{ $tag['id'] }}, '{{ $tag['content'] }}', '{{ $tag['type'] }}'])"
                class="w-full px-4 py-2 text-left text-white  {{ in_array($tag, $selectedTags) ? 'bg-red-900/30' : '' }}"
                wire:key="tag-{{ $tag['id'] . rand(1, 1000) }}">
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
</div>