<?php

namespace App\Livewire;

use Filament\Support\Contracts\HasLabel;

enum UrlParamType: string implements HasLabel
{
    case TAG = 'tag';
    case INPUT = 'input';
    case RELEASE_DATE = 'release_date';

    /**
     * Get the label for the tag type.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::TAG => 'Tag',
            self::INPUT => 'Input',
            self::RELEASE_DATE => 'Release Date',
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
            self::RELEASE_DATE => '<i class="pr-1 fas fa-calendar-alt"></i>',
            default => throw new \Exception('Invalid tag type'),
        };
    }

    /**
     * Get the tag type from a label.
     */
    public static function fromLabel(string $label): UrlParamType
    {
        return match ($label) {
            self::TAG->getLabel() => self::TAG,
            self::INPUT->getLabel() => self::INPUT,
            self::RELEASE_DATE->getLabel() => self::RELEASE_DATE,
            default => throw new \Exception("Invalid tag type: $label"),
        };
    }
}
