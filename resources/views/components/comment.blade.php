<div class="comment-section">
    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">User <span
            class="blood-red">Reviews</span></h2>

    <!-- Comment Form -->
    <div class="p-6 mb-8 bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold text-white">Leave a Review</h3>
        <livewire:comment-form :post="$post" />
    </div>

    <div class="space-y-2">

        <x-comment-list :post="$post" />

        {{-- <!-- Review Item -->
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
        </div> --}}
    </div>

    <!-- Pagination -->
    {{-- <div class="mt-8">
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
    </div> --}}
</div>