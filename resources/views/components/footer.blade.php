<footer class="flex-none py-8 mt-20 border-t thick-border">
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <div>
                <h3 class="mb-4 text-xl horror-title blood-red">{{ config('app.name', 'Horror Brains') }}</h3>
                <p class="text-sm text-gray-400">Your ultimate resource for horror movie enthusiasts, providing
                    up-to-date movie releases and discussion opportunities.</p>
            </div>

            <div>
                <h4 class="mb-4 font-semibold text-white">Quick Filters</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('movie.search', ['order_by' => 'created_at', 'order_direction' => 'desc']) }}" class="text-gray-400 hover:text-white">Latest Added</a></li>
                    <li><a href="{{ route('movie.search', ['order_by' => 'rating', 'order_direction' => 'desc']) }}" class="text-gray-400 hover:text-white">Top Rated</a></li>
                    <li><a href="{{ route('movie.search', ['order_by' => 'post_comments_count', 'order_direction' => 'desc']) }}" class="text-gray-400 hover:text-white">Most Commented</a></li>
                    <li><a href="{{ route('movie.search', ['start_date' => now()->format('Y-m-d')]) }}" class="text-gray-400 hover:text-white">Coming Soon</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-4 font-semibold text-white">Random Tags</h4>
                <ul class="space-y-2 text-sm">
                    @foreach ($randomTags as $tag)
                        <li><a href="{{ route('movie.search', ['tag' => [$tag->getKey()]]) }}" class="text-gray-400 hover:text-white">{{ $tag->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="mb-4 font-semibold text-white">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('aboutus') }}" class="text-gray-400 hover:text-white">About Us</a></li>
                    <li><a href="{{ route('privacypolicy') }}" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    <li><a href="{{ route('termsconditions') }}" class="text-gray-400 hover:text-white">Terms and Conditions</a></li>
                    <li><a href="{{ route('commentpolicy') }}" class="text-gray-400 hover:text-white">Comment Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="pt-6 mt-8 text-sm text-center text-gray-500 border-t light-border">
            <p>&copy; {{ date('Y') }} {{ ucwords(strtolower(config('app.name', 'Horror Brains'))) }}. All rights reserved.</p>
        </div>
    </div>
</footer>