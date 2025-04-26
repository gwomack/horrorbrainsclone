@php use App\Livewire\UrlParamType; @endphp

@section('title', 'About Us')

<div class="container mx-auto min-h-screen lg:px-4 lg:pb-8">

    <!-- Movie Details Section -->
    <div class="grid grid-cols-1 gap-20 lg:grid-cols-4">

        <!-- Main Content -->
        <div class="space-y-12 lg:col-span-3">
            <div>
                <h1 class="pb-6 text-4xl font-bold tracking-tight text-white md:text-6xl horror-title blood-red">
                    About Us
                </h1>

                <p class="leading-relaxed text-gray-300">
                    Welcome to {{ config('app.name') }} – not just another website, but a space pulsating with the dark
                    heart of the horror genre. Born from an undeniable passion shared by true horror aficionados, this
                    platform is fueled by dedication and the insatiable curiosity of enthusiasts like you.
                    <br><br>
                    We are more than just curators; we are die-hard fans who live and breathe horror.
                    <br><br>
                    Our mission is simple yet relentless: to keep you on the bleeding edge of horror cinema. We strive
                    to deliver the latest news, the most anticipated releases, and spine-tingling insights, often before
                    anyone else dares to whisper them.
                    <br><br>
                    We aim to be your comprehensive, go-to crypt for all things horror, excavating everything from
                    mainstream slashers to obscure independent gems. We champion unique perspectives and foster
                    discussion, creating a community where your screams, theories, and ratings matter.
                    <br><br>
                    Beyond the news and insights, {{ config('app.name') }} offers a powerful way to navigate the vast
                    world of
                    horror. We believe finding your next scare should be intuitive. That's why movies here are
                    meticulously categorized.
                    <br><br>
                    Explore films by genre, delve into specific sub-genres, discover movies based on unique themes, or
                    even search by other key facets. Our goal is to tag pertinent aspects, allowing you to customize
                    your search and uncover hidden gems or rediscover old favorites based on exactly what chills you
                    seek.
                    <br><br>
                    This detailed system ensures you spend less time searching and more time screaming.
                    <br><br>
                    This sanctuary is built for you, the unwavering horror community. Your engagement, passion, and
                    contributions are what bring {{ config('app.name') }} to life (or perhaps, undeath?). Thank you for
                    joining us
                    in this realm where fear and fascination intertwine.
                </p>

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