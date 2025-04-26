<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name') }} - Your ultimate resource for horror movies">

    <title>{{ config('app.name', 'Horror Brains') }} - @yield('title', 'Latest Horror Movies')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @livewireStyles
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen antialiased bg-black site">
    <!-- Header -->
    @persist('header')
    <header class="container fixed top-0 right-0 left-0 z-50 p-4 mx-auto bg-black">
        <div class="mx-auto max-w-3xl text-center">
            <div class="logo-container">
                <a href="/" wire:navigate>
                    <h1 class="inline-block mb-2 text-4xl horror-title md:text-6xl blood-red">{{ config('app.name',
                        'Horror
                        Brains') }}</h1>
                </a>
            </div>
            {{-- <p class="mb-4 text-xl text-gray-300">Your ultimate resource for horror movie enthusiasts</p>
            --}}
            <!-- Navigation Menu -->
            <nav class="container mx-auto nav-container">
                <div class="flex relative justify-center items-center h-10">
                    <div class="hidden space-x-8 md:flex" id="desktop-menu">
                        <a href="{{ route('movie.search', ['order_by' => 'trending']) }}"
                            class="text-gray-300 hover:text-white">
                            <i class="text-red-600 fas fa-fire"></i>
                            <span class="text-sm font-medium whitespace-nowrap">Trending Now</span>
                        </a>
                        <a href="{{ route('movie.search', ['order_by' => 'rating', 'order_direction' => 'desc']) }}"
                            class="text-gray-300 hover:text-white">
                            <i class="text-yellow-500 fas fa-star"></i>
                            <span class="text-sm font-medium whitespace-nowrap">Top Rated</span>
                        </a>
                        <a href="{{ route('movie.search', ['start_date' => now()->format('Y-m-d')]) }}"
                            class="text-gray-300 hover:text-white">
                            <i class="text-gray-400 fas fa-calendar"></i>
                            <span class="text-sm font-medium whitespace-nowrap">Coming Soon</span>
                        </a>
                        <a href="{{ route('aboutus') }}" class="text-gray-300 hover:text-white">About Us</a>
                        @auth
                        <a href="{{ route('filament.admin.auth.login') }}" class="text-gray-300 hover:text-white">
                            <i class="fas fa-user"></i>
                        </a>
                        @endauth
                    </div>
                    <button class="text-gray-300 hover:text-white md:hidden" id="mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu"
                        class="hidden absolute right-0 top-full z-50 mt-2 w-48 bg-black rounded-lg border border-gray-700 shadow-lg">
                        <div class="py-2">
                            <a href="{{ route('movie.search', ['order_by' => 'trending']) }}"
                                class="block px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800">Trending
                                Now</a>
                            <a href="{{ route('movie.search', ['order_by' => 'rating', 'order_direction' => 'desc']) }}"
                                class="block px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800">Top Rated</a>
                            <a href="{{ route('movie.search', ['start_date' => now()->format('Y-m-d')]) }}"
                                class="block px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800">Coming Soon</a>
                            <a href="{{ route('aboutus') }}"
                                class="block px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800">About Us</a>
                            @auth
                            <a href="{{ route('filament.admin.auth.login') }}"
                                class="block px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800">
                                <i class="mr-2 fas fa-user"></i>Account
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
            <div class="relative pr-4 search-bar-container">
                <livewire:main-search-bar.main-search-bar />
            </div>
        </div>
    </header>
    @endpersist

    <main class="flex-grow pt-56">
        {{ $slot }}
    </main>


    <!-- Footer -->
    <x-footer />

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.querySelector('#mobile-menu-button');
            const dropdownMenu = document.querySelector('#dropdown-menu');
            const header = document.querySelector('header');
            let lastScrollTop = 0;

            checkCompact();

            // Toggle dropdown menu
            menuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownMenu.contains(e.target) && !menuButton.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // Header scroll effect
            window.addEventListener('scroll', function() {
                checkCompact();
            });

            // Check if the header should be compact
            function checkCompact() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 20) {
                    header.classList.add('compact');
                } else {
                    header.classList.remove('compact');
                    // Hide dropdown when scrolling up from compact mode
                    dropdownMenu.classList.add('hidden');
                }

                lastScrollTop = scrollTop;
            }
        });
    </script>

    @livewire('notifications')

    @livewireScripts
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>