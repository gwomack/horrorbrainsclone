<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Horror Brains') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    {{-- @filamentStyles --}}
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased bg-black">
    <!-- Navigation -->
    <nav class="bg-black border-b border-gray-800">
        <div class="container px-4 mx-auto">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-white">
                        {{ config('app.name', 'Horror Brains') }}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 md:flex">
                    <a href="/" class="text-gray-300 hover:text-white">Home</a>
                    <a href="/categories" class="text-gray-300 hover:text-white">Categories</a>
                    <a href="/years" class="text-gray-300 hover:text-white">Years</a>
                    <a href="/about" class="text-gray-300 hover:text-white">About</a>
                </div>

                <!-- Search -->
                <div class="flex items-center">
                    <form action="/search" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Search movies..."
                            class="px-4 py-2 w-64 text-white bg-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <i class="text-gray-400 fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black border-t border-gray-800">
        <div class="container px-4 py-8 mx-auto">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-white">About {{ config('app.name', 'Horror Brains') }}
                    </h3>
                    <p class="text-gray-400">Your go-to source for horror movie news, reviews, and discussions.</p>
                </div>
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-white">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/categories" class="text-gray-400 hover:text-white">Categories</a></li>
                        <li><a href="/years" class="text-gray-400 hover:text-white">Years</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="/contact" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-white">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="/privacy" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                        <li><a href="/terms" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                        <li><a href="/cookies" class="text-gray-400 hover:text-white">Cookie Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-white">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="pt-8 mt-8 border-t border-gray-800">
                <p class="text-center text-gray-400">
                    © {{ date('Y') }} {{ config('app.name', 'Horror Brains') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    {{-- @filamentScripts --}}
    @vite('resources/js/app.js')
</body>

</html>