<?php

namespace App\Livewire\MainSearchBar;

use App\Livewire\UrlParamType;
use App\Models\Tag\Tag;

class SearchUrlParameters
{
    /**
     * Convert selected tags to URL parameters
     */
    public function toUrlParameters(array $selected): array
    {
        $params = [];

        foreach ($selected as $key => $tag) {
            $type = $tag['type']->value;
            if (! isset($params[$type])) {
                $params[$type] = [];
            }

            // For tag type, use the key (tag ID)
            // For other types, use the content
            $value = $type === UrlParamType::TAG->value ? $key : $tag['content'];
            $params[$type][] = $value;
        }

        return $params;
    }

    /**
     * Convert URL parameters to selected tags format
     */
    public function toSelected(array $params): array
    {
        $selected = [];
        $tagIds = [];
        $inputValues = [];

        // First pass: collect all tag IDs and input values
        foreach ($params as $type => $values) {
            foreach ($values as $value) {
                switch ($type) {
                    case UrlParamType::TAG->value:
                        $tagIds[] = $value;
                        break;
                    case UrlParamType::INPUT->value:
                        $inputValues[] = $value;
                        break;
                }
            }
        }

        // Batch fetch all tags at once
        if (! empty($tagIds)) {
            $tags = Tag::whereIn('id', $tagIds)->get()->keyBy('id');

            // Process tags
            foreach ($tagIds as $tagId) {
                if (isset($tags[$tagId])) {
                    $selected[$tagId] = [
                        'content' => $tags[$tagId]->name,
                        'type' => UrlParamType::TAG,
                    ];
                }
            }
        }

        // Process input values
        foreach ($inputValues as $value) {
            $tag = ['content' => $value, 'type' => UrlParamType::INPUT];
            $checksum = $this->generateChecksum($tag);
            $selected[$checksum] = $tag;
        }

        return $selected;
    }

    /**
     * Generate a checksum for a tag
     */
    protected function generateChecksum(array $tag): string
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
     * @param  mixed  $value
     * @return mixed
     */
    protected function cleanParameter($value)
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
     * Clean URL parameters
     */
    public function cleanParameters(array $params): array
    {
        $cleaned = [];

        foreach ($params as $type => $values) {
            $cleanedValue = $this->cleanParameter($values);

            if (! empty($cleanedValue)) {
                $cleaned[$type] = $cleanedValue;
            }
        }

        return $cleaned;
    }

    /**
     * Get URL parameters from request
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getFromRequest($request): array
    {
        $params = [];

        foreach (UrlParamType::cases() as $type) {
            $value = $request->get($type->value);
            if (! empty($value)) {
                $params[$type->value] = is_array($value) ? $value : [$value];
            }
        }

        return $this->cleanParameters($params);
    }
}
