<?php

namespace App\Livewire;

use App\Models\Tag\TagType;
use Filament\Support\Contracts\HasLabel;

enum UrlParamType: string implements HasLabel
{
    case TAG = 'tag';
    case INPUT = 'input';
    case START_DATE = 'start_date';
    case END_DATE = 'end_date';
    case RATING = 'rating';

    /**
     * Get the tag type from a value.
     */
    public static function fromKey(int|string $value): static
    {
        return match ($value) {
            self::TAG->value => self::TAG,
            self::INPUT->value => self::INPUT,
            self::START_DATE->value => self::START_DATE,
            self::END_DATE->value => self::END_DATE,
            self::RATING->value => self::RATING,
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
            self::START_DATE => 'Start Date',
            self::END_DATE => 'End Date',
            self::RATING => 'Rating',
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
            self::START_DATE => '<i class="pr-1 fas fa-calendar-alt"></i>',
            self::END_DATE => '<i class="pr-1 fas fa-calendar-alt"></i>',
            self::RATING => '<i class="pr-1 fas fa-star"></i>',
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
            self::START_DATE->getLabel() => self::START_DATE,
            self::END_DATE->getLabel() => self::END_DATE,
            self::RATING->getLabel() => self::RATING,
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
