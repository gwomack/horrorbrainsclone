@extends('layouts.horror')

@section('title', 'The Haunting of Willow Creek')

@section('content')
<div class="min-h-screen bg-black">
    <!-- Hero Section with Movie Poster -->
    <div class="relative">
        <div class="container px-4 py-12 mx-auto max-w-3xl lg:py-20">
            <div class="">
                <!-- Movie Poster -->
                <div x-data="{
                    images: [
                        'https://source.unsplash.com/random/800x600?nature=1',
                        'https://source.unsplash.com/random/800x600?nature=2',
                        'https://source.unsplash.com/random/800x600?nature=3',
                        'https://source.unsplash.com/random/800x600?nature=4'
                    ],
                    activeIndex: 0,
                    prev() {
                        this.activeIndex = this.activeIndex === 0 ? this.images.length - 1 : this.activeIndex - 1;
                    },
                    next() {
                        this.activeIndex = this.activeIndex === this.images.length - 1 ? 0 : this.activeIndex + 1;
                    },
                    autoplay: true,
                    pause: false
                }"
                x-init="if(autoplay) setInterval(() => { if(!pause) next() }, 3000)"
                @mouseenter="pause = true"
                @mouseleave="pause = false"
                class="mx-auto max-w-3xl">

                    <!-- Main Slider -->
                    <div class="overflow-hidden relative rounded-lg shadow-xl">
                        <div class="relative h-96">
                            <template x-for="(image, index) in images" :key="index">
                                <div
                                    x-show="activeIndex === index"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-90"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-90"
                                    class="absolute w-full h-full">
                                    <img :src="image" class="object-cover w-full h-full" alt="Slider image">
                                </div>
                            </template>
                        </div>

                        <!-- Navigation Buttons -->
                        <button @click="prev()" class="absolute left-4 top-1/2 p-2 rounded-full transform -translate-y-1/2 bg-white/80 hover:bg-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button @click="next()" class="absolute right-4 top-1/2 p-2 rounded-full transform -translate-y-1/2 bg-white/80 hover:bg-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        <template x-for="(image, index) in images" :key="index">
                            <button
                                @click="activeIndex = index"
                                :class="activeIndex === index ? 'ring-2 ring-blue-500' : ''"
                                class="overflow-hidden rounded-lg ring-blue-300 shadow-md transition-all hover:ring-2">
                                <img
                                    :src="image"
                                    class="object-cover w-full h-24 transition duration-300 transform hover:scale-110"
                                    alt="Thumbnail">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Movie Info -->
                <div class="">
                    <h1 class="mb-4 text-4xl font-bold text-[#f8f8f8] md:text-5xl horror-title blood-red">The Haunting of Willow Creek</h1>
                    <div class="flex flex-wrap gap-4 mb-6">
                        <div class="flex items-center">
                            <div class="flex text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-[#9ca3af]">4.5/5</span>
                        </div>
                        <span class="text-[#9ca3af]">2024</span>
                        <span class="text-[#9ca3af]">1h 45m</span>
                        <span class="px-3 py-1 text-sm text-[#f8f8f8] bg-[#b91c1c] rounded-full">Supernatural Horror</span>
                    </div>

                    <!-- Synopsis -->
                    <div class="mb-8">
                        <h2 class="mb-3 text-xl font-semibold text-[#f8f8f8] horror-text">Synopsis</h2>
                        <p class="text-[#9ca3af]">
                            After inheriting an old Victorian mansion in the remote town of Willow Creek, Sarah Thompson and her family move in, hoping for a fresh start. But the house holds dark secrets. As strange occurrences begin to plague their daily lives, Sarah discovers that the mansion was once a sanctuary for troubled souls, and some of them never left. With the help of a local historian and a paranormal investigator, she must uncover the truth before her family becomes the next victims of the house's malevolent past.
                        </p>
                    </div>

                    <!-- Cast & Crew -->
                    <div class="mb-8">
                        <h2 class="mb-3 text-xl font-semibold text-[#f8f8f8] horror-text">Cast & Crew</h2>
                        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                            <div class="text-center">
                                <img src="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg" alt="Emma Stone" class="mx-auto mb-2 w-20 h-20 rounded-full">
                                <p class="text-sm text-[#f8f8f8]">Emma Stone</p>
                                <p class="text-xs text-[#6b7280]">Sarah Thompson</p>
                            </div>
                            <div class="text-center">
                                <img src="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg" alt="Michael Fassbender" class="mx-auto mb-2 w-20 h-20 rounded-full">
                                <p class="text-sm text-[#f8f8f8]">Michael Fassbender</p>
                                <p class="text-xs text-[#6b7280]">David Thompson</p>
                            </div>
                            <div class="text-center">
                                <img src="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg" alt="Viola Davis" class="mx-auto mb-2 w-20 h-20 rounded-full">
                                <p class="text-sm text-[#f8f8f8]">Viola Davis</p>
                                <p class="text-xs text-[#6b7280]">Dr. Margaret Chen</p>
                            </div>
                            <div class="text-center">
                                <img src="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg" alt="James McAvoy" class="mx-auto mb-2 w-20 h-20 rounded-full">
                                <p class="text-sm text-[#f8f8f8]">James McAvoy</p>
                                <p class="text-xs text-[#6b7280]">Marcus Bennett</p>
                            </div>
                        </div>
                    </div>

                    <!-- Where to Watch -->
                    <div class="mb-8">
                        <h2 class="mb-3 text-xl font-semibold text-[#f8f8f8] horror-text">Where to Watch</h2>
                        <div class="flex flex-wrap gap-4">
                            <a href="#" class="flex items-center px-4 py-2 text-[#f8f8f8] bg-[#b91c1c] rounded-lg hover:bg-[#991b1b] transition-all duration-300">
                                <i class="mr-2 fab fa-amazon"></i> Amazon Prime
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-[#f8f8f8] bg-[#b91c1c] rounded-lg hover:bg-[#991b1b] transition-all duration-300">
                                <i class="mr-2 fab fa-netflix"></i> Netflix
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Movie Details Section -->
    <div class="container px-4 py-12 mx-auto">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Trailer -->
                <div class="mb-8">
                    <h2 class="mb-4 text-2xl font-bold text-[#f8f8f8] horror-text">Trailer</h2>
                    <div class="relative pb-[56.25%] h-0">
                        <iframe
                            width="560"
                            height="315"
                            src="https://www.youtube.com/embed/WqBILPra47g?si=0P7CB7VRLNXFU0mD"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <!-- Movie Details -->
                <div class="mb-8">
                    <h2 class="mb-4 text-2xl font-bold text-[#f8f8f8] horror-text">Movie Details</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[#9ca3af]">Release Date</p>
                            <p class="text-[#f8f8f8]">March 15, 2024</p>
                        </div>
                        <div>
                            <p class="text-[#9ca3af]">Director</p>
                            <p class="text-[#f8f8f8]">James Wan</p>
                        </div>
                        <div>
                            <p class="text-[#9ca3af]">Writer</p>
                            <p class="text-[#f8f8f8]">David Leslie Johnson</p>
                        </div>
                        <div>
                            <p class="text-[#9ca3af]">Production</p>
                            <p class="text-[#f8f8f8]">New Line Cinema</p>
                        </div>
                    </div>
                </div>

                <!-- User Reviews -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-[#f8f8f8] horror-text">User Reviews</h2>
                    <div class="space-y-6">
                        <!-- Review Item -->
                        <div class="p-4 bg-[#111827] rounded-lg movie-card border border-[#1f2937]">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="ml-2 text-[#9ca3af]">5.0</span>
                            </div>
                            <p class="text-[#9ca3af]">A masterclass in atmospheric horror! The tension builds perfectly throughout the film, and the performances are outstanding. The house itself becomes a character, and the supernatural elements are handled with subtlety and intelligence.</p>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm text-[#6b7280]">By HorrorFan123</span>
                                <span class="text-sm text-[#6b7280]">March 20, 2024</span>
                            </div>
                        </div>
                        <!-- Second Review -->
                        <div class="p-4 bg-[#111827] rounded-lg movie-card border border-[#1f2937]">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-[#9ca3af]">4.0</span>
                            </div>
                            <p class="text-[#9ca3af]">The first two acts are brilliant, with great character development and creepy atmosphere. The final act could have been stronger, but overall it's a solid supernatural horror film.</p>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm text-[#6b7280]">By MovieBuff456</span>
                                <span class="text-sm text-[#6b7280]">March 18, 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Similar Movies -->
                <div class="mb-8">
                    <h2 class="mb-4 text-xl font-bold text-[#f8f8f8] horror-text">Similar Movies</h2>
                    <div class="space-y-4">
                        <a href="#" class="flex items-center p-2 bg-[#111827] rounded-lg hover:bg-[#1f2937] movie-card border border-[#1f2937] transition-all duration-300">
                            <img src="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg" alt="The Conjuring" class="mr-3 w-16 h-24 rounded">
                            <div>
                                <h3 class="text-[#f8f8f8]">The Conjuring</h3>
                                <p class="text-sm text-[#9ca3af]">2013 • Supernatural Horror</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center p-2 bg-[#111827] rounded-lg hover:bg-[#1f2937] movie-card border border-[#1f2937] transition-all duration-300">
                            <img src="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg" alt="Insidious" class="mr-3 w-16 h-24 rounded">
                            <div>
                                <h3 class="text-[#f8f8f8]">Insidious</h3>
                                <p class="text-sm text-[#9ca3af]">2010 • Supernatural Horror</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Movie Tags -->
                <div>
                    <h2 class="mb-4 text-xl font-bold text-[#f8f8f8] horror-text">Movie Tags</h2>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-3 py-1 text-sm text-[#f8f8f8] bg-[#1f2937] rounded-full hover:bg-[#374151] transition-all duration-300">Haunted House</a>
                        <a href="#" class="px-3 py-1 text-sm text-[#f8f8f8] bg-[#1f2937] rounded-full hover:bg-[#374151] transition-all duration-300">Supernatural</a>
                        <a href="#" class="px-3 py-1 text-sm text-[#f8f8f8] bg-[#1f2937] rounded-full hover:bg-[#374151] transition-all duration-300">Family Drama</a>
                        <a href="#" class="px-3 py-1 text-sm text-[#f8f8f8] bg-[#1f2937] rounded-full hover:bg-[#374151] transition-all duration-300">Psychological</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
