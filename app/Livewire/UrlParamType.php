<?php

namespace App\Livewire;

use App\Models\Tag\TagType;
use Filament\Support\Contracts\HasLabel;

enum UrlParamType: string implements HasLabel
{
    case TAG = 'tag';
    case INPUT = 'input';
    case RELEASE_DATE = 'release_date';

    /**
     * Get the tag type from a value.
     */
    public static function myFrom(int|string $value): static
    {
        return match ($value) {
            self::TAG->value => self::TAG,
            self::INPUT->value => self::INPUT,
            self::RELEASE_DATE->value => self::RELEASE_DATE,
            default => self::TAG,
        };
    }

    /**
     * Get the label for the tag type.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::TAG => 'Tag',
            self::INPUT => 'Input',
            self::RELEASE_DATE => 'Release Date',
            default => 'Tag',
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
            default => '<i class="pr-1 fas fa-tag"></i>',
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
            default => self::TAG,
        };
    }

    /**
     * Get the URL param type from a tag type value.
     */
    public static function fromTagTypeValue(string $tagTypeValue): UrlParamType
    {
        return match ($tagTypeValue) {
            TagType::TAG->value => self::TAG,
            self::INPUT->value => self::INPUT,
            default => self::TAG,
        };
    }

    /**
     * Get the URL param type from a tag type.
     */
    public static function fromTagType(TagType $tagType): UrlParamType
    {
        return self::fromTagTypeValue($tagType->value);
    }
}
