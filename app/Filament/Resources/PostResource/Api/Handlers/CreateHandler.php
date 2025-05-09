<?php

namespace App\Filament\Resources\PostResource\Api\Handlers;

use App\Models\Tag\Tag;
use App\Models\Tag\Year;
use App\Models\Post\Post;
use App\Models\Tag\Field;
use App\Models\Tag\Genre;
use App\Models\Tag\Acting;
use App\Models\Tag\Writer;
use App\Models\Tag\Country;
use App\Models\Tag\TagType;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Tag\Director;
use App\Models\Tag\Language;
use App\Models\Tag\SubGenre;
use App\Models\Post\EmbedType;
use App\Models\Tag\Production;
use App\Models\Tag\Distribution;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Tag\TrendingHomePage;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\PostResource\Api\Requests\CreatePostRequest;

class CreateHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = PostResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Create Post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePostRequest $request)
    {
        try {

            DB::beginTransaction();

            Log::debug($request->all());

            $model = new (static::getModel());

            if ($year = $request->get('year')) {
                if (is_array($year)) {
                    $year = $year[0];
                }

                if (! Str::contains($request->get('title'), "({$year})")) {
                    $request->merge(['title' => $request->get('title').' ('.$year.')']);
                }
            }

            $model->fill(
                $request->merge(['description' => $request->get('synopsis')])->only(
                    (new Post)->getFillable()
                )
            );

            $model->save();

            if ($acting = $request->get('actors')) {
                $acting = Arr::wrap($acting);

                foreach ($acting as $act) {
                    $name = trim($act['name'] ?? null);
                    if (! empty($name)) {
                        $character = trim($act['character'] ?? null);
                        $slug = Str::slug($name);
                        $actModel = Tag::where('slug', $slug)->first();

                        if (! $actModel) {
                            $actModel = Acting::create(['name' => $name]);
                        }

                        $custom = [];

                        if (! empty($character)) {
                            $custom = [
                                'custom' => [
                                    'field' => Field::AS->value,
                                    'value' => $character,
                                ],
                            ];
                        }

                        $actModel->parents()->syncWithoutDetaching(
                            Tag::firstOrCreate(['slug' => TagType::ACTING->value])->getKey()
                        );
                        $model->acting()->attach($actModel->getKey(), $custom);
                    }
                }
            }

            if ($director = $request->get('directors')) {
                $director = Arr::wrap($director);

                foreach ($director as $dir) {
                    $dir = trim($dir);
                    $slug = Str::slug($dir);
                    $dirModel = Tag::where('slug', $slug)->first();

                    if (! $dirModel) {
                        $dirModel = Director::create(['name' => $dir]);
                    }

                    $dirModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::DIRECTOR->value])->getKey()
                    );
                    $model->director()->attach($dirModel->getKey());
                }
            }

            if ($writer = $request->get('writers')) {
                $writer = Arr::wrap($writer);

                foreach ($writer as $wri) {
                    $wri = trim($wri);
                    $slug = Str::slug($wri);
                    $wriModel = Tag::where('slug', $slug)->first();

                    if (! $wriModel) {
                        $wriModel = Writer::create(['name' => $wri]);
                    }

                    $wriModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::WRITER->value])->getKey()
                    );
                    $model->writer()->attach($wriModel->getKey());
                }
            }

            if ($production = $request->get('production_companies')) {
                $production = Arr::wrap($production);

                foreach ($production as $prod) {
                    $prod = trim($prod);
                    $slug = Str::slug($prod);
                    $prodModel = Tag::where('slug', $slug)->first();

                    if (! $prodModel) {
                        $prodModel = Production::create(['name' => $prod]);
                    }

                    $prodModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::PRODUCTION->value])->getKey()
                    );
                    $model->production()->attach($prodModel->getKey());
                }
            }

            if ($distribution = $request->get('distribution_companies')) {
                $distribution = Arr::wrap($distribution);

                foreach ($distribution as $dist) {
                    $dist = trim($dist);
                    $slug = Str::slug($dist);
                    $distModel = Tag::where('slug', $slug)->first();

                    if (! $distModel) {
                        $distModel = Distribution::create(['name' => $dist]);
                    }

                    $distModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::DISTRIBUTION->value])->getKey()
                    );
                    $model->distribution()->attach($distModel->getKey());
                }
            }

            if ($country = $request->get('countries')) {
                $country = Arr::wrap($country);

                foreach ($country as $coun) {
                    $coun = trim($coun);
                    $slug = Str::slug($coun);
                    $counModel = Tag::where('slug', $slug)->first();

                    if (! $counModel) {
                        $counModel = Country::create(['name' => $coun]);
                    }

                    $counModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::COUNTRY->value])->getKey()
                    );
                    $model->country()->attach($counModel->getKey());
                }
            }

            if ($language = $request->get('languages')) {
                $language = Arr::wrap($language);

                foreach ($language as $lang) {
                    $lang = trim($lang);
                    $slug = Str::slug($lang);
                    $langModel = Tag::where('slug', $slug)->first();

                    if (! $langModel) {
                        $langModel = Language::create(['name' => $lang]);
                    }

                    $langModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::LANGUAGE->value])->getKey()
                    );
                    $model->language()->attach($langModel->getKey());
                }
            }

            if ($subGenre = $request->get('sub_genres')) {
                $subGenre = Arr::wrap($subGenre);

                foreach ($subGenre as $sub) {
                    $sub = trim($sub);
                    $slug = Str::slug($sub);
                    $subModel = Tag::where('slug', $slug)->first();

                    if (! $subModel) {
                        $subModel = SubGenre::create(['name' => $sub]);
                    }

                    $subModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::SUB_GENRE->value])->getKey()
                    );
                    $model->subGenre()->attach($subModel->getKey());
                }
            }

            if ($genre = $request->get('genres')) {
                $genre = Arr::wrap($genre);

                foreach ($genre as $gen) {
                    $gen = trim($gen);
                    $slug = Str::slug($gen);
                    $genModel = Tag::where('slug', $slug)->first();

                    if (! $genModel) {
                        $genModel = Genre::create(['name' => $gen]);
                    }

                    $genModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::GENRE->value])->getKey()
                    );
                    $model->genre()->attach($genModel->getKey());
                }
            }

            if ($year = $request->get('year')) {
                $year = Arr::wrap($year);

                foreach ($year as $ye) {
                    $ye = trim($ye);
                    $slug = Str::slug($ye);
                    $yeModel = Tag::where('slug', $slug)->first();

                    if (! $yeModel) {
                        $yeModel = Year::create(['name' => $ye]);
                    }

                    $yeModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::YEAR->value])->getKey()
                    );
                    $model->year()->attach($yeModel->getKey());
                }
            }

            if ($thp = $request->get('trending_home_page')) {
                $thp = Arr::wrap($thp);

                foreach ($thp as $th) {
                    $th = trim($th);
                    $slug = Str::slug($th);
                    $thpModel = Tag::where('slug', $slug)->first();

                    if (! $thpModel) {
                        $thpModel = TrendingHomePage::create(['name' => $th]);
                    }

                    $thpModel->parents()->syncWithoutDetaching(
                        Tag::firstOrCreate(['slug' => TagType::TRENDING_HOME_PAGE->value])->getKey()
                    );
                    $model->trendingHomePage()->attach($thpModel->getKey());
                }
            }

            $postType = Tag::where('slug', 'movie')->first();
            $postType && $model->postType()->attach($postType->getKey());

            if ($tmdb_id = $request->get('tmdb_id')) {
                $model->postExtra()->create([
                    'tmdb_id' => $tmdb_id,
                ]);
            }

            if ($images = $request->get('images')) {
                $images = Arr::wrap($images);

                foreach ($images as $img) {
                    $model->addMediaFromUrl($img)->toMediaCollection('images', 'post');
                }
            }

            if ($youtube_trailers = $request->get('youtube_trailers')) {
                $youtube_trailers = Arr::wrap($youtube_trailers);

                foreach ($youtube_trailers as $yt) {
                    $model->embeds()->create([
                        'embed' => $yt,
                        'type' => EmbedType::YOUTUBE,
                        'is_published' => true,
                    ]);
                }
            }

            DB::commit();

            return static::sendSuccessResponse($model, 'Successfully Create Resource');

        } catch (\Throwable $th) {

            throw $th;
            Log::error($th);

            // return response()->json([
            //     'message' => $th->getMessage(),
            // ], 500);
        }
    }
}
