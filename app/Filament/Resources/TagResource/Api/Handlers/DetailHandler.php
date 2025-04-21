<?php

namespace App\Filament\Resources\TagResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\TagResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\TagResource\Api\Transformers\TagTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = TagResource::class;


    /**
     * Show Tag
     *
     * @param Request $request
     * @return TagTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new TagTransformer($query);
    }
}
