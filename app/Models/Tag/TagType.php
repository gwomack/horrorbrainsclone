<?php

namespace App\Models\Tag;

use Filament\Support\Contracts\HasLabel;

enum TagType: string implements HasLabel
{
    case TAG = 'tag';
    case ACTING = 'acting';
    case DIRECTOR = 'director';
    case WRITER = 'writer';
    case PRODUCTION = 'production';
    case DISTRIBUTION = 'distribution';
    case LANGUAGE = 'language';
    case COUNTRY = 'country';
    case YEAR = 'year';
    case GENRE = 'genre';
    case SUB_GENRE = 'sub-genre';
    case POST_TYPE = 'post-type';
    case TRENDING_HOME_PAGE = 'trending-home-page';

    /**
     * Get the label for the tag type.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::TAG => 'Tag',
            self::ACTING => 'Acting',
            self::DIRECTOR => 'Director',
            self::WRITER => 'Writer',
            self::PRODUCTION => 'Production',
            self::DISTRIBUTION => 'Distribution',
            self::LANGUAGE => 'Language',
            self::COUNTRY => 'Country',
            self::YEAR => 'Year',
            self::GENRE => 'Genre',
            self::SUB_GENRE => 'Sub Genre',
            self::POST_TYPE => 'Post Type',
            self::TRENDING_HOME_PAGE => 'Trending Home Page',
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
            self::ACTING => '<i class="pr-1 fas fa-user"></i>',
            self::DIRECTOR => '<i class="pr-1 fas fa-user"></i>',
            self::WRITER => '<i class="pr-1 fas fa-user"></i>',
            self::PRODUCTION => '<i class="pr-1 fas fa-user"></i>',
            self::DISTRIBUTION => '<i class="pr-1 fas fa-user"></i>',
            self::LANGUAGE => '<i class="pr-1 fas fa-language"></i>',
            self::COUNTRY => '<i class="pr-1 fas fa-flag"></i>',
            self::YEAR => '<i class="pr-1 fas fa-calendar"></i>',
            self::GENRE => '<i class="pr-1 fas fa-film"></i>',
            self::SUB_GENRE => '<i class="pr-1 fas fa-film"></i>',
            self::TRENDING_HOME_PAGE => '<i class="pr-1 fas fa-home"></i>',
            default => '<i class="pr-1 fas fa-tag"></i>',
        };
    }

    /**
     * Get the tag type from a label.
     */
    public static function fromLabel(string $label): TagType
    {
        return match ($label) {
            self::TAG->getLabel() => self::TAG,
            self::ACTING->getLabel() => self::ACTING,
            self::DIRECTOR->getLabel() => self::DIRECTOR,
            self::WRITER->getLabel() => self::WRITER,
            self::PRODUCTION->getLabel() => self::PRODUCTION,
            self::DISTRIBUTION->getLabel() => self::DISTRIBUTION,
            self::LANGUAGE->getLabel() => self::LANGUAGE,
            self::COUNTRY->getLabel() => self::COUNTRY,
            self::YEAR->getLabel() => self::YEAR,
            self::GENRE->getLabel() => self::GENRE,
            self::SUB_GENRE->getLabel() => self::SUB_GENRE,
            self::TRENDING_HOME_PAGE->getLabel() => self::TRENDING_HOME_PAGE,
            default => self::TAG,
        };
    }
}
