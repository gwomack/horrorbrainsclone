<?php

use App\Livewire\MainSearchBar\SearchUrlParameters;
use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;
use App\Models\Tag\TagType;
use App\View\Components\Tag\TagToUrlParameter;
use Illuminate\Http\Request;

// it('renders successfully', function () {
//     login()
//         ->get('/search?tag[]=tag1&tag[]=tag2')
//         ->assertStatus(200);
// });

it('gets the parameters from the request', function () {
    $urlSentParams = [
        TagType::TAG->value => ['tag1', 'tag2'],
        'input' => ['test'],
        TagType::DIRECTOR->value => ['test'],
        TagType::ACTING->value => ['test'],
        TagType::YEAR->value => ['2020'],
    ];
    $correctResponseParams = [
        UrlParamType::TAG->value => ['tag1', 'tag2', 'test', '2020'],
        UrlParamType::INPUT->value => ['test'],
    ];

    $request = new Request;
    $request->query->set('tag', $urlSentParams['tag']);
    $request->query->set('input', $urlSentParams['input']);
    $request->query->set('acting', $urlSentParams['acting']);
    $request->query->set('director', $urlSentParams['director']);
    $request->query->set('year', $urlSentParams['year']);

    $parameters = new SearchUrlParameters;
    $response = $parameters->getFromRequest($request);

    expect($response)->toBe($correctResponseParams);
});

it('ignores non array parameters', function () {
    $request = new Request;
    $request->query->set('page', 1);
    $parameters = new SearchUrlParameters;
    $response = $parameters->getFromRequest($request);

    expect($response)->toBe([]);
});

it('removes script tags from parameters and returns the correct parameters', function () {
    $script = '<script>alert("test")</script>';
    $cleanedScript = 'alert("test")';
    $params = [
        TagType::TAG->value => [$script, 'tag2'],
        'input' => [$script],
        TagType::ACTING->value => [$script],
        TagType::DIRECTOR->value => [$script],
        TagType::YEAR->value => ['year'],
        TagType::COUNTRY->value => [19900],
        $script => [$script],
    ];
    $request = new Request;
    $request->query->set(TagType::TAG->value, $params['tag']);
    $request->query->set('input', $params['input']);
    $request->query->set(TagType::ACTING->value, $params['acting']);
    $request->query->set(TagType::DIRECTOR->value, $params['director']);
    $request->query->set(TagType::YEAR->value, $params['year']);
    $request->query->set($script, $params[$script]);
    $request->query->set(TagType::COUNTRY->value, $params[TagType::COUNTRY->value]);
    $cleanedParams = [
        TagType::TAG->value => [$cleanedScript, 'tag2', TagType::YEAR->value, '19900'],
        'input' => [$cleanedScript],
    ];

    $parameters = new SearchUrlParameters;
    $response = $parameters->getFromRequest($request);

    expect($response)->toBe($cleanedParams);
});

it('converts received parameters correctly to selected tags format', function () {
    $tag1 = Tag::factory()->create();
    $tag2 = Tag::factory()->create();
    $params = [
        TagType::TAG->value => [$tag1->id, $tag2->id],
        'input' => ['test'],
    ];
    $parameters = new SearchUrlParameters;
    $checksum = $parameters->generateChecksum(['name' => 'test', 'type' => UrlParamType::INPUT]);
    $correctResponse = collect([
        $tag1->id => $tag1,
        $tag2->id => $tag2,
        $checksum => new Tag(['name' => 'test', 'type' => UrlParamType::INPUT, 'id' => $checksum]),
    ]);

    $response = $parameters->fromRequestToSelected($params);

    expect(array_diff($response->keys()->toArray(), $correctResponse->keys()->toArray()))->toBe([]);
});

it('converts selected parameters to url parameters', function () {
    $tag1 = Tag::factory()->create();
    $tag2 = Tag::factory()->create();
    $parameters = new SearchUrlParameters;
    $inputTagArr = ['name' => 'test', 'type' => UrlParamType::INPUT];
    $checksum = $parameters->generateChecksum($inputTagArr);
    $inputTag = new TagToUrlParameter([...$inputTagArr, 'id' => $checksum]);
    $params = collect([
        $tag1->id => $tag1->toArray(),
        $tag2->id => $tag2->toArray(),
        $checksum => $inputTag->toArray(),
    ]);
    $correctResponse = [
        TagType::TAG->value => [$tag1->id, $tag2->id],
        'input' => ['test'],
    ];
    $response = $parameters->fromSelectedToUrl($params);

    expect($response)->toBe($correctResponse);
});
