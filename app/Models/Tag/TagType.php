<?php

namespace App\Models\Tag;

use Filament\Support\Contracts\HasLabel;

enum TagType: string implements HasLabel
{
    case TAG = 'tag';
    case INPUT = 'input';
    case ACTING = 'acting';
    case DIRECTOR = 'director';
    case WRITER = 'writer';
    case PRODUCTION = 'production';
    case DISTRIBUTION = 'distribution';

    /**
     * Get the label for the tag type.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::TAG => 'Tag',
            self::INPUT => 'Input',
            self::ACTING => 'Acting',
            self::DIRECTOR => 'Director',
            self::WRITER => 'Writer',
            self::PRODUCTION => 'Production',
            self::DISTRIBUTION => 'Distribution',
            default => throw new \Exception('Invalid tag type'),
        };
    }

    /**
     * Get the icon for the tag type.
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::TAG => '<i class="pr-1 fas fa-tag"></i>',
            self::INPUT => '<i class="pr-1 fas fa-italic"></i>',
            default => throw new \Exception('Invalid tag type'),
        };
    }

    /**
     * Get the tag type from a label.
     */
    public static function fromLabel(string $label): TagType
    {
        return match ($label) {
            self::TAG->getLabel() => self::TAG,
            self::INPUT->getLabel() => self::INPUT,
            default => throw new \Exception("Invalid tag type: $label"),
        };
    }
}
