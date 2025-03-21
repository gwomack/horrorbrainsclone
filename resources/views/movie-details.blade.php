@extends('layouts.horror')

@section('title', 'The Haunting of Willow Creek')

@section('content')
<div class="container mx-auto min-h-screen">

    <!-- Movie Details Section -->
    <div class="grid grid-cols-1 gap-20 lg:grid-cols-3">

        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="mb-12">
                <h1 class="text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">The Haunting of Willow Creek</h1>
            </div>

            <!-- Hero Section with Movie Poster -->
            <livewire:photo-gallery />

            <!-- Movie Info -->
            <div class="space-y-8">
                <div class="flex flex-wrap gap-6 items-center mb-8">
                    <div class="flex items-center space-x-2">
                        <div class="flex text-yellow-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="font-medium text-gray-300">4.5/5</span>
                    </div>
                    <span class="text-gray-300">2024</span>
                    <span class="text-gray-300">1h 45m</span>
                    <span class="px-4 py-1.5 text-sm font-medium text-white bg-red-700 rounded-full shadow-lg transition-all duration-300 hover:bg-red-600">Supernatural Horror</span>
                </div>

                <!-- Synopsis -->
                <div class="mb-12">
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Movie <span class="blood-red">Synopsis</span></h2>
                    <p class="leading-relaxed text-gray-300">
                        After inheriting an old Victorian mansion in the remote town of Willow Creek, Sarah Thompson and her family move in, hoping for a fresh start. But the house holds dark secrets. As strange occurrences begin to plague their daily lives, Sarah discovers that the mansion was once a sanctuary for troubled souls, and some of them never left. With the help of a local historian and a paranormal investigator, she must uncover the truth before her family becomes the next victims of the house's malevolent past.
                    </p>
                </div>

                <!-- Cast & Crew -->
                <div class="mb-12">
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Cast & <span class="blood-red">Crew</span></h2>
                    <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                        <div class="p-4 text-center bg-gray-800 rounded-lg transition-all duration-300 hover:bg-gray-700">
                            <p class="font-medium text-white">Emma Stone</p>
                            <p class="text-sm text-gray-400">Sarah Thompson</p>
                        </div>
                        <div class="p-4 text-center bg-gray-800 rounded-lg transition-all duration-300 hover:bg-gray-700">
                            <p class="font-medium text-white">Michael Fassbender</p>
                            <p class="text-sm text-gray-400">David Thompson</p>
                        </div>
                        <div class="p-4 text-center bg-gray-800 rounded-lg transition-all duration-300 hover:bg-gray-700">
                            <p class="font-medium text-white">Viola Davis</p>
                            <p class="text-sm text-gray-400">Dr. Margaret Chen</p>
                        </div>
                        <div class="p-4 text-center bg-gray-800 rounded-lg transition-all duration-300 hover:bg-gray-700">
                            <p class="font-medium text-white">James McAvoy</p>
                            <p class="text-sm text-gray-400">Marcus Bennett</p>
                        </div>
                    </div>
                </div>

                <!-- Where to Watch -->
                <div class="mb-12">
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Where to <span class="blood-red">Watch</span></h2>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="flex items-center px-6 py-3 text-white bg-red-700 rounded-lg shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fab fa-amazon"></i> Amazon Prime
                        </a>
                        <a href="#" class="flex items-center px-6 py-3 text-white bg-red-700 rounded-lg shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fab fa-netflix"></i> Netflix
                        </a>
                    </div>
                </div>

                <!-- Movie Details -->
            <div class="mb-12">
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Movie <span class="blood-red">Details</span></h2>
                <div class="grid grid-cols-2 gap-6">
                    <div class="p-4 bg-gray-800 rounded-lg">
                        <p class="text-gray-400">Release Date</p>
                        <p class="font-medium text-white">March 15, 2024</p>
                    </div>
                    <div class="p-4 bg-gray-800 rounded-lg">
                        <p class="text-gray-400">Director</p>
                        <p class="font-medium text-white">James Wan</p>
                    </div>
                    <div class="p-4 bg-gray-800 rounded-lg">
                        <p class="text-gray-400">Writer</p>
                        <p class="font-medium text-white">David Leslie Johnson</p>
                    </div>
                    <div class="p-4 bg-gray-800 rounded-lg">
                        <p class="text-gray-400">Production</p>
                        <p class="font-medium text-white">New Line Cinema</p>
                    </div>
                </div>
            </div>

            <!-- User Reviews -->
            <div>
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">User <span class="blood-red">Reviews</span></h2>
                <div class="space-y-6">

                    <!-- Review Item -->
                    <div class="p-6 bg-gray-800 rounded-lg border border-gray-700 transition-all duration-300 hover:border-gray-600">
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 font-medium text-gray-300">5.0</span>
                        </div>
                        <p class="leading-relaxed text-gray-300">A masterclass in atmospheric horror! The tension builds perfectly throughout the film, and the performances are outstanding. The house itself becomes a character, and the supernatural elements are handled with subtlety and intelligence.</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-sm text-gray-400">By HorrorFan123</span>
                            <span class="text-sm text-gray-400">March 20, 2024</span>
                        </div>
                    </div>

                    <!-- Second Review -->
                    <div class="p-6 bg-gray-800 rounded-lg border border-gray-700 transition-all duration-300 hover:border-gray-600">
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="ml-2 font-medium text-gray-300">4.0</span>
                        </div>
                        <p class="leading-relaxed text-gray-300">The first two acts are brilliant, with great character development and creepy atmosphere. The final act could have been stronger, but overall it's a solid supernatural horror film.</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-sm text-gray-400">By MovieBuff456</span>
                            <span class="text-sm text-gray-400">March 18, 2024</span>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Similar Movies -->
            <div class="mb-12">
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Similar <span class="blood-red">Movies</span></h2>
                <div class="space-y-4">
                    <x-movie-block
                        title="The Conjuring"
                        image="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg"
                        rating="5.0"
                        description="A chilling tale of a family haunted by a dark presence in their farmhouse."
                        year="2013"
                        genre="Supernatural Horror"
                        badge="TRENDING"
                    />
                    <x-movie-block
                        title="Insidious"
                        image="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg"
                        rating="4.0"
                        description="A family discovers their son has the ability to travel to the spirit world."
                        year="2010"
                        genre="Supernatural Horror"
                        badge="CLASSIC"
                    />
                </div>
            </div>

            <!-- Movie Tags -->
            <div>
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Movie <span class="blood-red">Tags</span></h2>
                <div class="flex flex-wrap gap-3">
                    <a href="#" class="px-4 py-2 text-sm text-white bg-gray-800 rounded-lg border border-gray-700 transition-all duration-300 hover:bg-gray-700 hover:border-gray-600">Haunted House</a>
                    <a href="#" class="px-4 py-2 text-sm text-white bg-gray-800 rounded-lg border border-gray-700 transition-all duration-300 hover:bg-gray-700 hover:border-gray-600">Supernatural</a>
                    <a href="#" class="px-4 py-2 text-sm text-white bg-gray-800 rounded-lg border border-gray-700 transition-all duration-300 hover:bg-gray-700 hover:border-gray-600">Family Drama</a>
                    <a href="#" class="px-4 py-2 text-sm text-white bg-gray-800 rounded-lg border border-gray-700 transition-all duration-300 hover:bg-gray-700 hover:border-gray-600">Psychological</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
