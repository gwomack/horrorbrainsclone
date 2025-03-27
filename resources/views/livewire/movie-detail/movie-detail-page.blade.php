@php use App\Livewire\UrlParamType; @endphp

@section('title', 'The Haunting of Willow Creek')

<div class="container mx-auto min-h-screen lg:py-8">

    <!-- Movie Details Section -->
    <div class="grid grid-cols-1 gap-20 lg:grid-cols-3">

        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">
                    The Haunting of Willow Creek
                </h1>
            </div>

            <div class="mt-6">
                <!-- Hero Section with Movie Poster -->
                <livewire:photo-gallery />
            </div>

            <!-- Movie Info -->
            <div class="space-y-12">

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
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-500">Release:</span>
                        <span class="text-gray-300">March 15, 2024</span>
                    </div>
                    <x-tag.tag id="200" content="2024" :type="UrlParamType::TAG" />
                </div>

                <!-- Synopsis -->
                <div class="">
                    {{-- <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Movie <span
                            class="blood-red">Synopsis</span></h2> --}}
                    <p class="leading-relaxed text-gray-300">
                        After inheriting an old Victorian mansion in the remote town of Willow Creek, Sarah Thompson and
                        her family move in, hoping for a fresh start. But the house holds dark secrets. As strange
                        occurrences begin to plague their daily lives, Sarah discovers that the mansion was once a
                        sanctuary for troubled souls, and some of them never left. With the help of a local historian
                        and a paranormal investigator, she must uncover the truth before her family becomes the next
                        victims of the house's malevolent past.
                    </p>
                </div>

                <!-- Movie Tags -->
                <div class="space-y-4">
                    {{-- <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Movie <span
                            class="blood-red">Tags</span></h2> --}}
                    <div class="flex gap-3 items-center">
                        <div class="flex-none">
                            <span class="text-gray-500">Genre:</span>
                        </div>
                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-3 scrollbar-hide">
                            <x-tag.tag id="1" content="Haunted House" :type="UrlParamType::TAG" />
                            <x-tag.tag id="2" content="Supernatural" :type="UrlParamType::TAG" />
                            <x-tag.tag id="3" content="Family Drama" :type="UrlParamType::TAG" />
                            <x-tag.tag id="4" content="Psychological" :type="UrlParamType::TAG" />
                            <x-tag.tag id="5" content="Supernatural Horror" :type="UrlParamType::TAG" />
                            <x-tag.tag id="6" content="Supernatural Horror" :type="UrlParamType::TAG" />
                            <x-tag.tag id="7" content="Supernatural Horror" :type="UrlParamType::TAG" />
                            <x-tag.tag id="8" content="Supernatural Horror" :type="UrlParamType::TAG" />
                            <x-tag.tag id="9" content="Supernatural Horror" :type="UrlParamType::TAG" />
                            <x-tag.tag id="10" content="Supernatural Horror" :type="UrlParamType::TAG" />
                        </div>
                    </div>

                    <!-- Cast -->
                    <div class="space-y-4">
                        {{-- <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Main <span
                                class="blood-red">Cast</span></h2> --}}
                        <div>
                            <div class="flex gap-3 items-center">
                                <div class="flex-none">
                                    <span class="text-gray-500">Acting:</span>
                                </div>
                                <div class="flex overflow-x-auto flex-nowrap flex-grow gap-1 scrollbar-hide">
                                    <div class="p-1 text-center">
                                        <x-tag.tag id="100" content="Emily Blunt" :type="UrlParamType::TAG" />
                                        <p class="text-sm text-gray-400 text-nowrap"><span class="italic">as</span>
                                            Sarah Thompson</p>
                                    </div>
                                    <div class="p-1 text-center">
                                        <x-tag.tag id="101" content="Michael Fassbender"
                                            :type="UrlParamType::TAG" />
                                        <p class="text-sm text-gray-400 text-nowrap"><span class="italic">as</span>
                                            David Thompson</p>
                                    </div>
                                    <div class="p-1 text-center">
                                        <x-tag.tag id="102" content="Viola Davis" :type="UrlParamType::TAG" />
                                        <p class="text-sm text-gray-400 text-nowrap"><span class="italic">as</span> Dr.
                                            Margaret Chen</p>
                                    </div>
                                    <div class="p-1 text-center">
                                        <x-tag.tag id="103" content="James McAvoy" :type="UrlParamType::TAG" />
                                        <p class="text-sm text-gray-400 text-nowrap"><span class="italic">as</span>
                                            Marcus Bennett</p>
                                    </div>
                                    <div class="p-1 text-center">
                                        <x-tag.tag id="104" content="Daniel Kaluuya" :type="UrlParamType::TAG" />
                                        <p class="text-sm text-gray-400 text-nowrap"><span class="italic">as</span>
                                            Marcus Bennett</p>
                                    </div>
                                    <div class="p-1 text-center">
                                        <x-tag.tag id="105" content="Daniel Kaluuya" :type="UrlParamType::TAG" />
                                        <p class="text-sm text-gray-400 text-nowrap"><span class="italic">as</span>
                                            Marcus Bennett</p>
                                    </div>
                                    <div class="p-1 text-center">
                                        <x-tag.tag id="106" content="Daniel Kaluuya" :type="UrlParamType::TAG" />
                                        <p class="text-sm text-gray-400 text-nowrap"><span class="italic">as</span>
                                            Marcus Bennett</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">

                            <div class="col-span-1 space-y-4">
                                <div>
                                    <div class="flex gap-3 items-center">
                                        <div class="flex-none">
                                            <span class="text-gray-500">Production:</span>
                                        </div>
                                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-3 scrollbar-hide">
                                            <x-tag.tag id="301" content="New Line Cinema"
                                                :type="UrlParamType::TAG" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex gap-3 items-center">
                                        <div class="flex-none">
                                            <span class="text-gray-500">Distribution:</span>
                                        </div>
                                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-3 scrollbar-hide">
                                            <x-tag.tag id="301" content="Warner Bros. Pictures"
                                                :type="UrlParamType::TAG" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1 space-y-4">
                                <div class="flex gap-3 items-center space-between">
                                    <div class="flex-none">
                                        <span class="text-gray-500">Director:</span>
                                    </div>
                                    <div class="flex overflow-x-auto flex-nowrap flex-grow gap-3 scrollbar-hide">
                                        <x-tag.tag id="300" content="John Doe" :type="UrlParamType::TAG" />
                                    </div>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <div class="flex-none">
                                        <span class="text-gray-500">Writer:</span>
                                    </div>
                                    <div class="flex overflow-x-auto flex-nowrap flex-grow gap-3 scrollbar-hide">
                                        <x-tag.tag id="301" content="Jane Doe" :type="UrlParamType::TAG" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1 space-y-4">
                                <div>
                                    <div class="flex gap-3 items-center">
                                        <div class="flex-none">
                                            <span class="text-gray-500">Country:</span>
                                        </div>
                                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-3 scrollbar-hide">
                                            <x-tag.tag id="301" content="United States"
                                                :type="UrlParamType::TAG" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex gap-3 items-center">
                                        <div class="flex-none">
                                            <span class="text-gray-500">Language:</span>
                                        </div>
                                        <div class="flex overflow-x-auto flex-nowrap flex-grow gap-3 scrollbar-hide">
                                            <x-tag.tag id="301" content="English" :type="UrlParamType::TAG" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- External Resources -->
                <div class="">
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">External <span
                            class="blood-red">Resources</span></h2>
                    <div class="flex flex-wrap gap-4">
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-yellow-600 rounded-lg shadow-lg transition-all duration-300 hover:bg-yellow-500">
                            <i class="mr-3 text-xl fab fa-imdb"></i> IMDb
                        </a>
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-red-700 rounded-lg shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fas fa-tv"></i> Trakt.tv
                        </a>
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-gray-700 rounded-lg shadow-lg transition-all duration-300 hover:bg-gray-600">
                            <i class="mr-3 text-xl fab fa-wikipedia-w"></i> Wikipedia
                        </a>
                    </div>
                </div>

                <!-- Where to Watch -->
                <div class="">
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Where to <span
                            class="blood-red">Watch</span></h2>
                    <div class="flex flex-wrap gap-4">
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-red-700 rounded-lg shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fab fa-amazon"></i> Amazon Prime
                        </a>
                        <a href="#"
                            class="flex items-center px-6 py-3 text-white bg-red-700 rounded-lg shadow-lg transition-all duration-300 hover:bg-red-600">
                            <i class="mr-3 text-xl fab fa-netflix"></i> Netflix
                        </a>
                    </div>
                </div>

                <!-- User Reviews -->
                <div>
                    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">User <span
                            class="blood-red">Reviews</span></h2>

                    <!-- Comment Form -->
                    <div class="p-6 mb-8 bg-gray-800 rounded-lg border border-gray-700">
                        <h3 class="mb-4 text-xl font-semibold text-white">Leave a Review</h3>
                        <form action="#" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    {{-- <label for="username"
                                        class="block mb-1 text-sm font-medium text-gray-300">Username</label> --}}
                                    <input type="text" placeholder="Username" id="username" name="username" required
                                        class="px-4 py-2 w-full text-white bg-gray-700 rounded-lg border border-gray-600 focus:outline-none focus:border-red-500">
                                </div>
                                <div>
                                    {{-- <label for="email"
                                        class="block mb-1 text-sm font-medium text-gray-300">Email</label> --}}
                                    <input type="email" placeholder="Email" id="email" name="email" required
                                        class="px-4 py-2 w-full text-white bg-gray-700 rounded-lg border border-gray-600 focus:outline-none focus:border-red-500">
                                </div>
                                <div class="col-span-2">
                                    {{-- <label for="comment" class="block mb-1 text-sm font-medium text-gray-300">Your
                                        Review</label> --}}
                                    <textarea id="comment" name="comment" placeholder="Your Review" rows="4" required
                                        class="px-4 py-2 w-full text-white bg-gray-700 rounded-lg border border-gray-600 resize-none focus:outline-none focus:border-red-500"></textarea>
                                </div>
                                <div class="col-span-2">
                                    <button type="submit"
                                        class="px-6 py-2 text-white bg-red-700 rounded-lg shadow-lg transition-all duration-300 hover:bg-red-600 focus:outline-none">
                                        Submit Review
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="space-y-2">

                        <!-- Review Item -->
                        <div class="p-6 bg-gray-900">
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
                            <p class="leading-relaxed text-gray-300">A masterclass in atmospheric horror! The tension
                                builds perfectly throughout the film, and the performances are outstanding. The house
                                itself becomes a character, and the supernatural elements are handled with subtlety and
                                intelligence.</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm text-gray-400">By HorrorFan123</span>
                                <span class="text-sm text-gray-400">March 20, 2024</span>
                            </div>
                        </div>

                        <!-- Second Review -->
                        <div class="p-6 bg-gray-800">
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
                            <p class="leading-relaxed text-gray-300">The first two acts are brilliant, with great
                                character development and creepy atmosphere. The final act could have been stronger, but
                                overall it's a solid supernatural horror film.</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm text-gray-400">By MovieBuff456</span>
                                <span class="text-sm text-gray-400">March 18, 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        <div class="flex justify-center">
                            <nav class="inline-flex relative z-0 -space-x-px rounded-md shadow-sm"
                                aria-label="Pagination">
                                <a href="#"
                                    class="inline-flex relative items-center px-2 py-2 text-sm font-medium text-gray-400 bg-gray-800 rounded-l-md border border-gray-700 hover:bg-gray-700">
                                    <span class="sr-only">Previous</span>
                                    <i class="w-5 h-5 leading-5 text-center fas fa-chevron-left"></i>
                                </a>
                                <a href="#"
                                    class="inline-flex relative items-center px-4 py-2 text-sm font-medium text-white bg-gray-900 border border-gray-700 hover:bg-gray-700">1</a>
                                <a href="#"
                                    class="inline-flex relative items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700">2</a>
                                <a href="#"
                                    class="inline-flex relative items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700">3</a>
                                <span
                                    class="inline-flex relative items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-800 border border-gray-700">...</span>
                                <a href="#"
                                    class="inline-flex relative items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700">8</a>
                                <a href="#"
                                    class="inline-flex relative items-center px-2 py-2 text-sm font-medium text-gray-400 bg-gray-800 rounded-r-md border border-gray-700 hover:bg-gray-700">
                                    <span class="sr-only">Next</span>
                                    <i class="w-5 h-5 leading-5 text-center fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Similar Movies -->
            <div class="">
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">Similar <span class="blood-red">Movies</span>
                </h2>
                <div class="space-y-4">
                    <x-movie-block title="The Conjuring"
                        image="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg"
                        rating="5.0"
                        description="A chilling tale of a family haunted by a dark presence in their farmhouse."
                        year="2013" genre="Supernatural Horror" badge="TRENDING" />
                    <x-movie-block title="Insidious"
                        image="https://m.media-amazon.com/images/M/MV5BMTY5NjI5NjY5Ml5BMl5BanBnXkFtZTgwNjY5NjI5NjY5._V1_.jpg"
                        rating="4.0"
                        description="A family discovers their son has the ability to travel to the spirit world."
                        year="2010" genre="Supernatural Horror" badge="CLASSIC" />
                </div>
            </div>
        </div>
    </div>
</div>
