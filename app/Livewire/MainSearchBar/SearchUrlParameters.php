<?php

namespace App\Livewire\MainSearchBar;

use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;
use App\View\Components\Tag\TagToUrlParameter;
use Illuminate\Support\Collection;

/**
 * Convert selected tags to URL parameters
 */
class SearchUrlParameters
{
    /**
     * Convert selected tags to URL parameters
     */
    public function fromSelectedToUrl(?Collection $selected): array
    {
        $params = [];

        foreach ($selected ?? [] as $key => $tag) {

            $type = $tag['type']->value;

            if (! isset($params[$type])) {
                $params[$type] = [];
            }

            match ($type) {
                UrlParamType::TAG->value => $params[$type][] = $key,
                default => $params[$type][] = $tag['name'],
            };
        }

        // dd($selected, $params);

        return $params;
    }

    /**
     * Convert filters to URL parameters
     */
    public function fromFiltersToUrl(Collection $filters): Collection
    {
        return $filters
            ->only(array_map(fn ($type) => $type->value, UrlParamType::cases()));
    }

    /**
     * Convert URL parameters to filters format
     */
    public function fromRequestToFilters(array $params): Collection
    {
        return collect($params)
            ->only(array_map(fn ($type) => $type->value, UrlParamType::cases()))
            ->except(['tag', 'input']);
    }

    /**
     * Convert URL parameters to selected tags format
     */
    public function fromRequestToSelected(array $params): Collection
    {
        $selected = collect();

        // First pass: collect all tag IDs and input values
        foreach ($params as $type => $values) {
            // dd($type, $values);
            switch ($type) {
                case UrlParamType::INPUT->value:
                    foreach ($values as $value) {
                        $prepareInputTag = ['name' => $value, 'type' => UrlParamType::INPUT];
                        $tag = new TagToUrlParameter([
                            'id' => $checksum = generateChecksum($prepareInputTag),
                            ...$prepareInputTag,
                        ]);
                        $selected = $selected->replace([$checksum => $tag->toArray()]);
                    }
                    break;
                case UrlParamType::TAG->value:
                    $selected = $selected->replace(Tag::whereIn('id', $values)->get()->keyBy('id')->toArray());
            }
        }

        return $selected;
    }

    /**
     * Validate URL parameters
     */
    public function validateParameters(array $params): bool
    {
        $validTypes = array_map(
            fn ($type) => $type->value,
            UrlParamType::cases()
        );

        foreach ($params as $type => $values) {
            if (! in_array($type, $validTypes)) {
                return false;
            }

            if (! is_array($values)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Clean a single parameter value
     *
     * @return string|array|null
     */
    protected function cleanParameter(array|string|null $value)
    {
        if (is_array($value)) {
            // Clean each array element
            $cleaned = array_map([$this, 'cleanParameter'], $value);

            // Remove empty values and reindex
            return array_values(array_filter($cleaned));
        }

        if (is_string($value)) {
            // Trim whitespace
            $value = trim($value);
            // Remove HTML tags
            $value = strip_tags($value);
            // Remove null bytes
            $value = str_replace("\0", '', $value);
            // Remove invisible characters
            $value = preg_replace('/[\x00-\x1F\x7F]/u', '', $value);
        }

        return $value;
    }

    /**
     * Get URL parameters from request
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getFromRequest($request): array
    {
        $params = [];

        foreach ($request->only(
            array_map(fn ($type) => $type->value, UrlParamType::cases())
        ) as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $cleanedKey = $this->cleanParameter($key);
                    $cleanedValue = $this->cleanParameter($v);
                    $params[UrlParamType::fromKey($cleanedKey)->value][] = $cleanedValue;
                    $params[UrlParamType::fromKey($cleanedKey)->value] =
                        array_unique($params[UrlParamType::fromKey($cleanedKey)->value]);
                }
            } else {
                $cleanedKey = $this->cleanParameter($key);
                $params[UrlParamType::fromKey($cleanedKey)->value] = $this->cleanParameter($value);
            }
        }

        return $params;
    }
}
