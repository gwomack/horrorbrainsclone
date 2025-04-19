<?php

namespace App\Filament\Resources\PostResource\Api\Handlers;

use App\Filament\Resources\PostResource;
use App\Filament\Resources\PostResource\Api\Requests\CreatePostRequest;
use App\Models\Post\EmbedType;
use App\Models\Tag\Acting;
use App\Models\Tag\Country;
use App\Models\Tag\Director;
use App\Models\Tag\Distribution;
use App\Models\Tag\Field;
use App\Models\Tag\Genre;
use App\Models\Tag\Language;
use App\Models\Tag\Production;
use App\Models\Tag\SubGenre;
use App\Models\Tag\Tag;
use App\Models\Tag\Writer;
use App\Models\Tag\Year;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Rupadana\ApiService\Http\Handlers;

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
                $request->merge(['description' => $request->get('synopsis')])->except(
                    'synopsis', 'tmdb_id', 'year', 'production_companies', 'distribution_companies',
                    'languages', 'countries', 'sub_genres', 'genres', 'writers', 'directors', 'actors',
                    'youtube_trailers', 'images'
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

                    $model->director()->attach($dirModel->getKey());
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

                    $model->genre()->attach($genModel->getKey());
                }
            }

            if ($writer = $request->get('writer')) {
                $writer = Arr::wrap($writer);

                foreach ($writer as $wri) {
                    $wri = trim($wri);
                    $slug = Str::slug($wri);
                    $wriModel = Tag::where('slug', $slug)->first();

                    if (! $wriModel) {
                        $wriModel = Writer::create(['name' => $wri]);
                    }

                    $model->writer()->attach($wriModel->getKey());
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

                    $model->year()->attach($yeModel->getKey());
                }
            }

            $postType = Tag::where('slug', 'movie')->first();
            $model->postType()->attach($postType->getKey());

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
