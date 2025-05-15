<?php

use App\Livewire\MovieSearchPage\MovieSearchPage;
use App\Livewire\MovieSearchPage\OrderByType;
use App\Livewire\MovieSearchPage\OrderDirectionType;
use App\Livewire\MovieSearchPage\PerPageType;
use App\Livewire\MovieSearchPage\SearchType;
use App\Models\Post\Post;
use Livewire\Livewire;
use Illuminate\Http\Request;

it('can search for movies by simple text', function () {
    // Create published and unpublished posts
    $matchingPost = Post::factory()->create([
        'title' => 'UniqueTestMovieTitle',
        'is_published' => true,
    ]);
    $nonMatchingPost = Post::factory()->create([
        'title' => 'AnotherMovie',
        'is_published' => true,
    ]);
    $unpublishedPost = Post::factory()->create([
        'title' => 'UniqueTestMovieTitle',
        'is_published' => false,
    ]);

    $filters = [
        'order_by' => OrderByType::TITLE->value,
        'order_direction' => OrderDirectionType::ASC->value,
        'per_page' => PerPageType::PER_PAGE_12->value,
        'page' => 1,
        'st' => false, // OR search
        'start_date' => null,
        'end_date' => null,
        'rating' => null,
    ];

    $request = Request::create('/movie-search', 'GET', [
        'input' => ['UniqueTestMovieTitle'],
        // add other parameters as needed
    ]);

    $this->app->instance('request', $request);

    Livewire::test(MovieSearchPage::class, [
        'filters' => $filters,
        'request' => $request,
    ])
        ->assertOk()
        ->assertSee('UniqueTestMovieTitle')
        ->assertDontSee('AnotherMovie');
});
