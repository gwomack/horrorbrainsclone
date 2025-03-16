@extends('layouts.horror')

@section('title', 'Latest Horror Movies')

@section('content')
    <!-- Hero Section -->
    <section class="relative">
        <!-- Hero Background -->
        <div class="absolute inset-0 z-10 bg-gradient-to-b from-black via-transparent to-black"></div>
        <div class="relative h-[500px] overflow-hidden">
            <img src="https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                 alt="Horror Movie Background"
                 class="object-cover object-center w-full h-full opacity-40">
        </div>

        <!-- Hero Content -->
        <div class="flex absolute inset-0 z-20 items-center">
            <div class="container px-4 mx-auto">
                <div class="max-w-2xl">
                    <h1 class="mb-4 text-4xl horror-title md:text-6xl blood-red">Horror Brains</h1>
                    <p class="mb-6 text-xl text-gray-200 md:text-2xl horror-text">Your ultimate resource for horror movie enthusiasts</p>
                    <p class="mb-8 text-gray-300">Discover the latest horror releases, read reviews, and join discussions with fellow horror fans.</p>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <a href="#latest" class="inline-flex justify-center items-center px-6 py-3 font-medium text-white bg-red-800 rounded-md hover:bg-red-700">
                            <i class="mr-2 fas fa-film"></i> Latest Releases
                        </a>
                        <a href="#" class="inline-flex justify-center items-center px-6 py-3 font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700">
                            <i class="mr-2 fas fa-star"></i> Top Rated
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Releases Section -->
    <section id="latest" class="py-12 bg-black">
        <div class="px-4 mx-auto lg:container">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-white md:text-3xl">Latest <span class="blood-red">Releases</span></h2>
                <a href="#" class="flex items-center text-sm text-gray-400 hover:text-white">
                    View All <i class="ml-2 fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- First Row - 2 Large Squares -->
            <div class="grid gap-2 mb-2 md:grid-cols-2">
                <!-- Large Movie Card 1 -->
                <div class="bg-black movie-card">
                    <div class="relative aspect-[16/9]">
                        <img src="https://m.media-amazon.com/images/M/MV5BMTg1OTkxMDQwNV5BMl5BanBnXkFtZTgwMjA1NDkxMzI@._V1_.jpg"
                             alt="A Quiet Place"
                             class="object-cover w-full h-full">
                        <div class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                            NEW
                        </div>
                        <div class="absolute bottom-0 left-0 p-4 w-full">
                            <h3 class="mb-2 text-xl font-semibold text-white">A Quiet Place</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-400">4.5/5</span>
                            </div>
                            <p class="text-sm text-gray-300">A family struggles to survive in a world where most humans have been killed by blind but noise-sensitive creatures.</p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-gray-400">2018 • Horror/Thriller</span>
                                <a href="#" class="text-sm text-red-600 hover:text-red-500">
                                    <i class="mr-1 fas fa-info-circle"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Large Movie Card 2 -->
                <div class="bg-black movie-card">
                    <div class="relative aspect-[16/9]">
                        <img src="https://m.media-amazon.com/images/M/MV5BZDVkZmI0YzAtNzdjYi00ZjhhLWE1ODEtMWMzMWMzNDA0NmQ4XkEyXkFqcGdeQXVyNzYzODM3Mzg@._V1_.jpg"
                             alt="IT"
                             class="object-cover w-full h-full">
                        <div class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                            NEW
                        </div>
                        <div class="absolute bottom-0 left-0 p-4 w-full">
                            <h3 class="mb-2 text-xl font-semibold text-white">IT</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-400">4.0/5</span>
                            </div>
                            <p class="text-sm text-gray-300">In the summer of 1989, a group of bullied kids band together to destroy a shape-shifting monster.</p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-gray-400">2017 • Horror/Supernatural</span>
                                <a href="#" class="text-sm text-red-600 hover:text-red-500">
                                    <i class="mr-1 fas fa-info-circle"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row and Beyond - 3 Squares -->
            <div class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5">
                <!-- Movie Card 3 -->
                <div class="bg-black movie-card">
                    <div class="relative aspect-square">
                        <img src="https://m.media-amazon.com/images/M/MV5BNzM0OGZiZWItYmZiNC00NDgzLTg1MjMtYjM4MWZhOGZhMDUwXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg"
                             alt="Midsommar"
                             class="object-cover w-full h-full">
                        <div class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                            NEW
                        </div>
                        <div class="absolute bottom-0 left-0 p-4 w-full">
                            <h3 class="mb-2 text-lg font-semibold text-white">Midsommar</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-400">3.5/5</span>
                            </div>
                            <p class="text-sm text-gray-300">A couple travels to Northern Europe to visit a rural hometown's fabled Swedish mid-summer festival.</p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-gray-400">2019 • Horror/Folk</span>
                                <a href="#" class="text-sm text-red-600 hover:text-red-500">
                                    <i class="mr-1 fas fa-info-circle"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Movie Card 4 -->
                <div class="bg-black movie-card">
                    <div class="relative aspect-square">
                        <img src="https://m.media-amazon.com/images/M/MV5BMjI0MDMzNTQ0M15BMl5BanBnXkFtZTgwMTM5NzM3NDM@._V1_.jpg"
                             alt="Hereditary"
                             class="object-cover w-full h-full">
                        <div class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                            NEW
                        </div>
                        <div class="absolute bottom-0 left-0 p-4 w-full">
                            <h3 class="mb-2 text-lg font-semibold text-white">Hereditary</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-400">5.0/5</span>
                            </div>
                            <p class="text-sm text-gray-300">A grieving family is haunted by tragic and disturbing occurrences after the death of their secretive grandmother.</p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-gray-400">2018 • Horror/Supernatural</span>
                                <a href="#" class="text-sm text-red-600 hover:text-red-500">
                                    <i class="mr-1 fas fa-info-circle"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Movie Card 5 -->
                <div class="bg-black movie-card">
                    <div class="relative aspect-square">
                        <img src="https://m.media-amazon.com/images/M/MV5BYTJlNDlkZTktNjEwOS00NzI5LTlkNDAtZmEwZDFmYmM2MjU2XkEyXkFqcGdeQXVyNjg2NjQwMDQ@._V1_.jpg"
                             alt="Us"
                             class="object-cover w-full h-full">
                        <div class="absolute top-2 right-2 px-2 py-1 text-xs text-white bg-red-800">
                            NEW
                        </div>
                        <div class="absolute bottom-0 left-0 p-4 w-full">
                            <h3 class="mb-2 text-lg font-semibold text-white">Us</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-400">4.5/5</span>
                            </div>
                            <p class="text-sm text-gray-300">A family's serene beach vacation turns to chaos when their doppelgängers appear and begin to terrorize them.</p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-gray-400">2019 • Horror/Thriller</span>
                                <a href="#" class="text-sm text-red-600 hover:text-red-500">
                                    <i class="mr-1 fas fa-info-circle"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Section -->
    <section class="py-12 bg-black">
        <div class="container px-4 mx-auto">
            <h2 class="mb-8 text-2xl font-bold text-white md:text-3xl">Featured <span class="blood-red">Movie</span></h2>

            <div class="overflow-hidden bg-gradient-to-r from-gray-900 to-black rounded-lg">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2">
                        <img src="https://m.media-amazon.com/images/M/MV5BYTdiOTIyZTQtNmQ1OS00NjZlLWIyMTgtYzk5Y2M3ZDVmMDk1XkEyXkFqcGdeQXVyMTAzMDg4NzU0._V1_.jpg"
                             alt="Terrifier 2"
                             class="object-cover w-full h-full">
                    </div>
                    <div class="flex flex-col justify-center p-6 md:w-1/2 md:p-8">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 mr-2 text-xs text-white bg-red-800 rounded">FEATURED</span>
                            <span class="text-sm text-gray-400">2022 • Horror/Slasher</span>
                        </div>
                        <h3 class="mb-3 text-2xl font-bold text-white md:text-3xl">Terrifier 2</h3>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-400">4.5/5</span>
                        </div>
                        <p class="mb-6 text-gray-300">After being resurrected by a sinister entity, Art the Clown returns to the timid town of Miles County where he targets a teenage girl and her younger brother on Halloween night.</p>
                        <div class="flex flex-wrap gap-3 mb-6">
                            <span class="px-3 py-1 text-xs text-gray-300 bg-gray-800 rounded-full">Slasher</span>
                            <span class="px-3 py-1 text-xs text-gray-300 bg-gray-800 rounded-full">Gore</span>
                            <span class="px-3 py-1 text-xs text-gray-300 bg-gray-800 rounded-full">Clown</span>
                            <span class="px-3 py-1 text-xs text-gray-300 bg-gray-800 rounded-full">Supernatural</span>
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="#" class="inline-flex justify-center items-center px-5 py-2 font-medium text-white bg-red-800 rounded-md hover:bg-red-700">
                                <i class="mr-2 fas fa-play"></i> Watch Trailer
                            </a>
                            <a href="#" class="inline-flex justify-center items-center px-5 py-2 font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700">
                                <i class="mr-2 fas fa-info-circle"></i> Read Review
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 bg-gray-900">
        <div class="container px-4 mx-auto">
            <h2 class="mb-8 text-2xl font-bold text-white md:text-3xl">Browse by <span class="blood-red">Category</span></h2>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <!-- Category 1 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1509248961158-e54f6934749c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Slasher"
                         class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Slasher</h3>
                        <p class="text-xs text-gray-300">42 movies</p>
                    </div>
                </a>

                <!-- Category 2 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Supernatural"
                         class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Supernatural</h3>
                        <p class="text-xs text-gray-300">38 movies</p>
                    </div>
                </a>

                <!-- Category 3 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1603720999656-f4f9d7c2c75e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Psychological"
                         class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Psychological</h3>
                        <p class="text-xs text-gray-300">29 movies</p>
                    </div>
                </a>

                <!-- Category 4 -->
                <a href="#" class="overflow-hidden relative h-40 rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Found Footage"
                         class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-lg font-semibold text-white">Found Footage</h3>
                        <p class="text-xs text-gray-300">17 movies</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="overflow-hidden relative py-12 bg-black">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1505236732171-72a5b19c4981?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80"
                 alt="Horror Background"
                 class="object-cover w-full h-full">
        </div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl horror-title md:text-4xl blood-red">Stay Updated</h2>
                <p class="mb-8 text-gray-300">Subscribe to our newsletter to get the latest horror movie updates, reviews, and exclusive content delivered straight to your inbox.</p>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 text-white bg-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-red-700">
                    <button class="px-6 py-3 font-medium text-white bg-red-800 rounded-md hover:bg-red-700">
                        Subscribe Now
                    </button>
                </div>
                <p class="mt-4 text-sm text-gray-500">By subscribing, you agree to our Privacy Policy and consent to receive updates from Horror Brains.</p>
            </div>
        </div>
    </section>
@endsection
