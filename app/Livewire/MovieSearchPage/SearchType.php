<?php

namespace App\Livewire\MovieSearchPage;

enum SearchType: string
{
    case AND = 'and';

    case OR = 'or';

    /**
     * Get the values
     *
     * @return array
     */
    public static function getValues()
    {
        return [
            self::AND,
            self::OR,
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
            self::AND => 'AND',
            self::OR => 'OR',
            default => 'OR',
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
            self::AND->value => self::AND->value,
            self::OR->value => self::OR->value,
            default => self::OR->value,
        };
    }
}
