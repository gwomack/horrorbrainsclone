<?php

namespace App\Livewire\MovieSearchPage;

enum OrderDirectionType: string
{
    case ASC = 'asc';

    case DESC = 'desc';

    /**
     * Get the values
     *
     * @return array
     */
    public static function getValues()
    {
        return [
            self::ASC,
            self::DESC,
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
            self::ASC => 'Asc',
            self::DESC => 'Desc',
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
            self::ASC->value => self::ASC->value,
            self::DESC->value => self::DESC->value,
            default => self::DESC->value,
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
