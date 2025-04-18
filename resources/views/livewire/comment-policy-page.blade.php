@php use App\Livewire\UrlParamType; @endphp

@section('title', 'Terms and Conditions')

<div class="container mx-auto min-h-screen lg:px-4 lg:pb-8">

    <!-- Movie Details Section -->
    <div class="grid grid-cols-1 gap-20 lg:grid-cols-4">

        <!-- Main Content -->
        <div class="space-y-12 lg:col-span-3">
            <div>
                <h1 class="pb-6 text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">
                    Comment Policy
                </h1>
                {{-- <p class="pb-8 text-sm text-gray-400">Last updated: November 1, 2024</p> --}}

                <div class="space-y-8 text-gray-300">
                    <p class="text-lg">Welcome to our community! We encourage thoughtful discussions and value your contributions. To maintain a positive environment for all users, please adhere to the following guidelines:</p>

                    <div class="space-y-6">
                        <div>
                            <h2 class="mb-4 text-2xl font-bold text-white">Community Guidelines</h2>
                            <ul class="pl-6 space-y-3 list-disc">
                                <li>Be respectful and considerate of others' opinions and perspectives</li>
                                <li>Keep discussions focused on the topic at hand</li>
                                <li>Use appropriate language and avoid offensive content</li>
                                <li>Refrain from personal attacks or harassment</li>
                                <li>Do not post spam, advertisements, or promotional content</li>
                                <li>Respect intellectual property rights and copyright laws</li>
                            </ul>
                        </div>

                        <div>
                            <h2 class="mb-4 text-2xl font-bold text-white">Content Moderation</h2>
                            <p>We reserve the right to moderate and remove comments that:</p>
                            <ul class="pl-6 mt-3 space-y-3 list-disc">
                                <li>Contain hate speech or discriminatory content</li>
                                <li>Include threats or harassment</li>
                                <li>Share personal or confidential information</li>
                                <li>Violate our community standards</li>
                                <li>Are off-topic or disruptive to discussions</li>
                            </ul>
                        </div>

                        <div>
                            <h2 class="mb-4 text-2xl font-bold text-white">User Responsibilities</h2>
                            <p>By participating in our community, you agree to:</p>
                            <ul class="pl-6 mt-3 space-y-3 list-disc">
                                <li>Take responsibility for your comments and their impact</li>
                                <li>Report inappropriate content when encountered</li>
                                <li>Respect the decisions of our moderation team</li>
                                <li>Maintain a constructive and positive atmosphere</li>
                            </ul>
                        </div>

                        <div>
                            <h2 class="mb-4 text-2xl font-bold text-white">Consequences</h2>
                            <p>Violations of these guidelines may result in:</p>
                            <ul class="pl-6 mt-3 space-y-3 list-disc">
                                <li>Removal of comments</li>
                                <li>Temporary or permanent suspension of commenting privileges</li>
                                <li>Account restrictions or termination</li>
                            </ul>
                        </div>

                        <div>
                            <h2 class="mb-4 text-2xl font-bold text-white">Contact</h2>
                            <p>If you have any questions or concerns about our comment policy, please contact our moderation team through the appropriate channels.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Similar Movies -->
            <div class="">
                <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">
                    Random <span class="blood-red">Movies</span>
                </h2>
                @foreach ($randomMovies as $movie)
                <x-movie.movie-block :noTagIcon="true" :movie="$movie" />
                @endforeach
            </div>
        </div>
    </div>
</div>
