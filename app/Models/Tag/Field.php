<?php

namespace App\Models\Tag;

use Filament\Support\Contracts\HasLabel;

enum Field: string implements HasLabel
{
    case AS = 'as';

    public function getLabel(): string
    {
        return match ($this) {
            self::AS => 'As',
            default => throw new \Exception('Invalid tag type'),
        };
    }

    /**
     * Get the field from the label.
     */
    public static function fromLabel(string $label): Field
    {
        return match ($label) {
            'As' => self::AS,
            default => throw new \Exception("Invalid tag type: $label"),
        };
    }
}
