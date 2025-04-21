<?php
namespace App\Filament\Resources\TagResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Tag\Tag;

/**
 * @property Tag $resource
 */
class TagTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
