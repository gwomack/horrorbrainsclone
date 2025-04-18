<?php

namespace App\View\Components\Tag;

use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;
use App\Models\Tag\TagType;

class TagToUrlParameter
{
    /**
     * The tag.
     */
    public ?Tag $tag;

    /**
     * The id of the tag.
     */
    public ?string $id;

    /**
     * The name of the tag.
     */
    public ?string $name;

    /**
     * The type of the tag.
     */
    public ?UrlParamType $type;

    /**
     * The constructor of the component.
     */
    public function __construct(
        array $params
    ) {
        $this->id = $params['id'] ?? $params['tag']->id;
        $this->name = $params['name'] ?? $params['tag']->name;

        if (is_string($params['type'])) {
            $this->type = UrlParamType::fromTagTypeValue($params['type']);
        } elseif ($params['type'] instanceof TagType) {
            $this->type = UrlParamType::fromTagType($params['type']);
        } elseif ($params['type'] instanceof UrlParamType) {
            $this->type = $params['type'];
        } else {
            $this->type = UrlParamType::fromTagTypeValue(
                $params['tag']->type->value ?? $params['tag']->type
            );
        }
    }

    /**
     * Convert the object to an array.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}
