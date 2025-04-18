<div
    x-data="{
        activeIndex: 0,
        media: {{ json_encode($media) }},
        setActive(index) {
            this.activeIndex = index;
        }
    }"
    x-cloak
    class="grid grid-cols-12 gap-2 mb-12"
>
    <!-- Main Content -->
    <div class="col-span-12 lg:col-span-10">
        <!-- Main Slider -->
        <div class="overflow-hidden relative h-96 shadow-xl">
            <div class="relative h-full">
                <template x-for="(item, index) in media" :key="'slide-' + index">
                    <div
                        x-show="activeIndex === index"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="h-full"
                    >
                        <div x-show="item.type === 'image'" class="h-full">
                            <img :src="item.url" class="object-cover mx-auto h-full" alt="Slider image">
                        </div>
                        <div x-show="item.type === 'youtube'" class="w-full h-full">
                            <iframe
                                :src="'https://www.youtube.com/embed/' + item.id"
                                class="w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Thumbnails -->
    <div class="col-span-12 gap-2 lg:col-span-2">
        <div class="flex flex-row flex-wrap gap-2 justify-center lg:flex-col">
            @foreach (array_slice($media, 0, 4) as $index => $item)
                <button
                    @click="setActive({{ $index }})"
                    :class="{ 'ring-2 ring-blue-500': activeIndex === {{ $index }} }"
                    class="overflow-hidden ring-blue-300 shadow-md transition-all lg:mx-auto hover:ring-2"
                >
                    <div class="w-auto h-24">
                        @if($item['type'] === 'image')
                            <img
                                src="{{ $item['url'] }}"
                                class="h-full transition duration-300 transform hover:scale-110"
                                alt="Thumbnail"
                            >
                        @elseif($item['type'] === 'youtube')
                            <img
                                src="https://img.youtube.com/vi/{{ $item['id'] }}/mqdefault.jpg"
                                class="object-cover h-full transition duration-300 transform hover:scale-110"
                                alt="YouTube Thumbnail"
                            >
                        @endif
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</div>
