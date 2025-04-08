<?php

namespace App\Livewire\MovieSearchPage;

enum OrderByType: string
{
    case RELEASE_DATE = 'release_date';

    case CREATED_AT = 'created_at';

    case TITLE = 'title';

    case RATING = 'rating';

    case VOTES = 'post_ratings_count';

    case TRENDING = 'trending';

    /**
     * Get the values
     *
     * @return array
     */
    public static function getValues()
    {
        return [
            self::RELEASE_DATE,
            self::CREATED_AT,
            self::TITLE,
            self::RATING,
            self::VOTES,
            self::TRENDING,
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
            self::RELEASE_DATE => 'Release Date',
            self::CREATED_AT => 'Date Added',
            self::TITLE => 'Title',
            self::RATING => 'Rating',
            self::VOTES => 'Votes',
            self::TRENDING => 'Trending',
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
            self::RELEASE_DATE->value => self::RELEASE_DATE->value,
            self::CREATED_AT->value => self::CREATED_AT->value,
            self::TITLE->value => self::TITLE->value,
            self::RATING->value => self::RATING->value,
            self::VOTES->value => self::VOTES->value,
            self::TRENDING->value => self::TRENDING->value,
            default => self::RELEASE_DATE->value,
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
