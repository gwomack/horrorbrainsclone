<?php

namespace App\Models\Tag;

use Filament\Support\Contracts\HasLabel;

enum TagType: string implements HasLabel
{
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

    /**
     * Get the label for the tag type.
     */
    public function getLabel(): string
    {
        return match ($this) {
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
            default => throw new \Exception('Invalid tag type'),
        };
    }

    /**
     * Get the icon for the tag type.
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::ACTING => '<i class="pr-1 fas fa-user"></i>',
            self::DIRECTOR => '<i class="pr-1 fas fa-user"></i>',
            self::WRITER => '<i class="pr-1 fas fa-user"></i>',
            self::PRODUCTION => '<i class="pr-1 fas fa-user"></i>',
            self::DISTRIBUTION => '<i class="pr-1 fas fa-user"></i>',
            self::LANGUAGE => '<i class="pr-1 fas fa-language"></i>',
            self::COUNTRY => '<i class="pr-1 fas fa-flag"></i>',
            self::YEAR => '<i class="pr-1 fas fa-calendar"></i>',
            default => throw new \Exception('Invalid tag type'),
        };
    }

    /**
     * Get the tag type from a label.
     */
    public static function fromLabel(string $label): TagType
    {
        return match ($label) {
            self::ACTING->getLabel() => self::ACTING,
            self::DIRECTOR->getLabel() => self::DIRECTOR,
            self::WRITER->getLabel() => self::WRITER,
            self::PRODUCTION->getLabel() => self::PRODUCTION,
            self::DISTRIBUTION->getLabel() => self::DISTRIBUTION,
            self::LANGUAGE->getLabel() => self::LANGUAGE,
            self::COUNTRY->getLabel() => self::COUNTRY,
            self::YEAR->getLabel() => self::YEAR,
            default => throw new \Exception("Invalid tag type: $label"),
        };
    }
}
