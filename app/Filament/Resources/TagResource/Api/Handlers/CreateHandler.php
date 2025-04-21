<?php
namespace App\Filament\Resources\TagResource\Api\Handlers;

use App\Models\Tag\Tag;
use App\Models\Tag\TagType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\TagResource;
use App\Filament\Resources\TagResource\Api\Requests\CreateTagRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = TagResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Tag
     *
     * @param CreateTagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateTagRequest $request)
    {
        DB::beginTransaction();

        $model = new (static::getModel());

        $model->fill($request->only((new Tag)->getFillable()));

        $model->save();

        // Parents

        if (is_array($request->get('parents'))) {
            $parents = $request->get('parents');
        } else {
            $parents = explode(',', $request->get('parents', ''));
        }

        foreach ($parents as $parent) {
            if (is_string($parent)) {
                $model->parents()->attach(
                    Tag::firstOrCreate(['slug' => $parent])->getKey()
                );
            } else {
                $model->parents()->attach($parent);
            }
        }

        DB::commit();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}