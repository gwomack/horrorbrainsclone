<?php

namespace App\Livewire\MovieSearchPage;

enum PerPageType: string
{
    case PER_PAGE_12 = '12';

    case PER_PAGE_24 = '24';

    case PER_PAGE_48 = '48';

    case PER_PAGE_96 = '96';

    /**
     * Get the values
     *
     * @return array
     */
    public static function getValues()
    {
        return [
            self::PER_PAGE_12,
            self::PER_PAGE_24,
            self::PER_PAGE_48,
            self::PER_PAGE_96,
        ];
    }

    /**
     * Get the label
     *
     * @param  string  $value
     * @return string
     */
    public static function getLabel($value)
    {
        return match ($value) {
            self::PER_PAGE_12 => '12',
            self::PER_PAGE_24 => '24',
            self::PER_PAGE_48 => '48',
            self::PER_PAGE_96 => '96',
        };
    }

    /**
     * Get the value
     *
     * @return string
     */
    public static function getValue($value)
    {
        return match ($value) {
            self::PER_PAGE_12->value => self::PER_PAGE_12->value,
            self::PER_PAGE_24->value => self::PER_PAGE_24->value,
            self::PER_PAGE_48->value => self::PER_PAGE_48->value,
            self::PER_PAGE_96->value => self::PER_PAGE_96->value,
            default => self::PER_PAGE_12->value,
        };
    }

    /**
     * Get the ids with labels
     *
     * @return array
     */
    public static function forSelect()
    {
        return array_map(function ($value) {
            return ['id' => $value->value, 'label' => self::getLabel($value)];
        }, self::getValues());
    }
}
