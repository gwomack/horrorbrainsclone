<div class="space-y-4">
    @foreach ($similarPosts as $post)
    <x-movie.movie-block :noTagIcon="true" :movie="$post" />
    @endforeach
</div>