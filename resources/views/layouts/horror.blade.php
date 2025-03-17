<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Horror Brains - Your ultimate resource for horror movies">

    <title>{{ config('app.name', 'Horror Brains') }} - @yield('title', 'Latest Horror Movies')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Special+Elite&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Horror Styles -->
    <style>
        body {
            background-color: #0a0a0a;
            color: #f8f8f8;
            font-family: 'Figtree', sans-serif;
        }

        .horror-title {
            font-family: 'Creepster', cursive;
        }

        .horror-text {
            font-family: 'Special Elite', cursive;
        }

        .blood-red {
            color: #b91c1c;
        }

        .movie-card {
            transition: all 0.3s ease;
            border: 1px solid #2d2d2d;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(180, 0, 0, 0.3);
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #b91c1c;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .nav-link:hover {
            color: #b91c1c;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen antialiased">
    <!-- Header -->
    <header class="top-0 z-50 bg-black border-b border-gray-800">
        <section class="py-8 bg-black">
            <div class="container px-4 mx-auto">
                <div class="mx-auto max-w-3xl text-center">
                    <h1 class="mb-2 text-4xl horror-title md:text-6xl blood-red">Horror Brains</h1>
                    <p class="mb-4 text-xl text-gray-300">Your ultimate resource for horror movie enthusiasts</p>
                    <!-- Navigation Menu -->
                    <nav class="bg-black">
                        <div class="container px-4 mx-auto">
                            <div class="flex justify-center items-center h-12">
                                <div class="hidden space-x-8 md:flex">
                                    <a href="#" class="text-gray-300 hover:text-white">Movies</a>
                                    <a href="#" class="text-gray-300 hover:text-white">Reviews</a>
                                    <a href="#" class="text-gray-300 hover:text-white">News</a>
                                    <a href="#" class="text-gray-300 hover:text-white">Community</a>
                                    <button class="text-gray-300 hover:text-white">
                                        <i class="fas fa-user"></i>
                                    </button>
                                </div>
                                <button class="text-gray-300 hover:text-white md:hidden">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                    <div class="relative">
                        <input type="text"
                            placeholder="Search for horror movies, reviews, or discussions..."
                            class="px-6 py-4 w-full text-lg text-white bg-black border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-transparent">
                        <button class="absolute right-4 top-1/2 px-6 py-2 text-white bg-red-800 rounded-md transform -translate-y-1/2 hover:bg-red-700">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-8 bg-black border-t border-gray-800">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div>
                    <h3 class="mb-4 text-xl horror-title blood-red">Horror Brains</h3>
                    <p class="text-sm text-gray-400">Your ultimate resource for horror movie enthusiasts, providing up-to-date movie releases, reviews, and discussion opportunities.</p>
                </div>

                <div>
                    <h4 class="mb-4 font-semibold text-white">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white">Latest Movies</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Top Rated</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Coming Soon</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Reviews</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 font-semibold text-white">Categories</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white">Slasher</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Supernatural</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Psychological</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Found Footage</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 font-semibold text-white">Connect With Us</h4>
                    <div class="flex space-x-4 text-gray-400">
                        <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                    <p class="mt-4 text-sm text-gray-400">Subscribe to our newsletter for the latest horror updates.</p>
                    <div class="flex mt-2">
                        <input type="email" placeholder="Your email" class="px-3 py-2 w-full text-sm text-white bg-gray-900 rounded-l focus:outline-none focus:ring-1 focus:ring-red-700">
                        <button class="px-3 py-2 text-sm text-white bg-red-800 rounded-r hover:bg-red-700">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>

            <div class="pt-6 mt-8 text-sm text-center text-gray-500 border-t border-gray-800">
                <p>&copy; {{ date('Y') }} Horror Brains. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.querySelector('button.md\\:hidden');
            const mobileMenu = document.querySelector('.md\\:hidden.hidden');

            menuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>
