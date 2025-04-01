<?php

namespace App\Livewire\MainSearchBar;

use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;
use Illuminate\Support\Collection;

/**
 * Convert selected tags to URL parameters
 */
class SearchUrlParameters
{
    /**
     * Convert selected tags to URL parameters
     */
    public function fromSelectedToUrl(Collection $selected): array
    {
        $params = [];

        foreach ($selected as $key => $tag) {

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
                        $tag = new Tag;
                        $tag->fill([
                            'id' => $checksum = $this->generateChecksum($prepareInputTag),
                            ...$prepareInputTag,
                        ]);
                        $selected = $selected->replace([$checksum => $tag]);
                    }
                    break;
                default:
                    $selected = $selected->replace(Tag::whereIn('id', $values)->get()->keyBy('id'));
            }
        }

        return $selected;
    }

    /**
     * Generate a checksum for a tag
     */
    public function generateChecksum(array $tag): string
    {
        return hash('crc32b', json_encode($tag));
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
     * @return string|array
     */
    protected function cleanParameter(array|string $value)
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

        foreach ($request->all() as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $cleanedKey = $this->cleanParameter($key);
                    $cleanedValue = $this->cleanParameter($v);
                    $params[UrlParamType::fromTagTypeValue($cleanedKey)->value][] = $cleanedValue;
                }
                $cleanedKey = $this->cleanParameter($key);
                $params[UrlParamType::fromTagTypeValue($cleanedKey)->value] =
                    array_unique($params[UrlParamType::fromTagTypeValue($cleanedKey)->value]);
            }
        }

        return $params;
    }
}
