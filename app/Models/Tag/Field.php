<?php

namespace App\Models\Tag;

enum Field: string
{
    case As = 'as';

    public function getLabel(): string
    {
        return match ($this) {
            self::As => 'as',
            default => throw new \Exception("Invalid tag type"),
        };
    }

    /**
     * Get the field from the label.
     */
    public static function fromLabel(string $label): Field
    {
        return match ($label) {
            'as' => self::As,
            default => throw new \Exception("Invalid tag type: $label"),
        };
    }
}
