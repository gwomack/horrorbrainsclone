<div class="relative">

    <!-- Dropdown Trigger -->
    <button wire:click="$dispatch('toggleDropdown')" class="focus:outline-none">
        {{-- <div class="flex justify-between items-center">
            <span>Tags</span>
            <i class="pl-1 text-xs text-gray-400 fas {{ $showDropdown ? 'fa-chevron-up' : 'fa-chevron-down' }}"></i>
        </div> --}}
        <div class="px-6 py-2 text-white bg-gray-900 rounded-md hover:bg-gray-800" title="Select Tags"><i
                class="fas fa-tag"></i>
        </div>
    </button>

    <livewire:tag.tag-combobox />

</div>