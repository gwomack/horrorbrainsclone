<div class="space-y-4">
    @foreach ($similarPosts as $post)
    <x-movie.movie-block :movie="$post" />
    @endforeach
</div>