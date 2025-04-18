<?php

use App\Livewire\MainSearchBar\MainSearchBar;
use App\Livewire\MainSearchBar\SearchUrlParameters;
use App\Models\Tag\Tag;
use Illuminate\Http\Request;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(MainSearchBar::class)->assertStatus(200);
});

it('renders the main search bar', function () {
    Livewire::test(MainSearchBar::class)->assertSee('MainInputSearch');
});

it('sets the input', function () {

    $input = fake()->word();

    Livewire::test(MainSearchBar::class, ['input' => $input])
        ->assertSet('input', $input);
});

it('sets the selected tags', function () {

    $tag1 = Tag::factory()->create();
    $tag2 = Tag::factory()->create();

    $selected = collect([
        $tag1->id => $tag1,
        $tag2->id => $tag2,
    ]);

    $component = Livewire::test(MainSearchBar::class, ['selected' => $selected]);

    // Compare collections by their values
    $component->assertSet('selected', function ($value) use ($selected) {
        return $value->pluck('name')->toArray() === $selected->pluck('name')->toArray();
    });
});

it('sets the tags', function () {
    $tags = collect([
        Tag::factory()->make(),
        Tag::factory()->make(),
    ]);

    $component = Livewire::test(MainSearchBar::class, ['tags' => $tags]);

    $component->assertSet('tags', $tags);
});

it('builds the selected tags from the request', function () {
    // Create tags and ensure they're saved
    $tag1 = Tag::factory()->create(['name' => 'tag1']);
    $tag2 = Tag::factory()->create(['name' => 'tag2']);

    // Create a request with query parameters
    $urlparams = new Request;
    $urlparams->query->set('tag', [$tag1->id, $tag2->id]);

    // First verify the request parameters are correct
    $urlHandler = new SearchUrlParameters;
    $params = $urlHandler->getFromRequest($urlparams);

    // Debug the request and parameters
    dump([
        'request_query' => $urlparams->query->all(),
        'params' => $params,
        'tag1_id' => $tag1->id,
        'tag2_id' => $tag2->id,
    ]);

    expect($params)->toHaveKey('tag')
        ->and($params['tag'])->toBe(["{$tag1->id}", "{$tag2->id}"]);

    // Debug the fromRequestToSelected method
    $selected = $urlHandler->fromRequestToSelected($params);
    dump([
        'selected' => $selected,
        'tag1_exists' => $selected->has($tag1->id),
        'tag2_exists' => $selected->has($tag2->id),
        'tag1_name' => $selected[$tag1->id]->name ?? 'not found',
        'tag2_name' => $selected[$tag2->id]->name ?? 'not found',
        'selected_count' => $selected->count(),
    ]);

    // Test the component with the request
    $component = Livewire::test(MainSearchBar::class, ['request' => $urlparams]);

    // Debug the component's selected property
    dump([
        'component_selected' => $component->get('selected'),
        'component_selected_count' => $component->get('selected')->count(),
        'component_view_data' => $component->viewData('selected'),
    ]);

    // First verify the component's selected property
    $component->assertSet('selected', function ($value) use ($tag1, $tag2) {
        return $value->count() === 2 &&
               $value->has($tag1->id) &&
               $value->has($tag2->id) &&
               $value[$tag1->id]->name === 'tag1' &&
               $value[$tag2->id]->name === 'tag2';
    });

    // Then verify the view has the correct data
    $component->assertViewHas('selected', function ($value) use ($tag1, $tag2) {
        return $value->count() === 2 &&
               $value->has($tag1->id) &&
               $value->has($tag2->id) &&
               $value[$tag1->id]->name === 'tag1' &&
               $value[$tag2->id]->name === 'tag2';
    });
});
