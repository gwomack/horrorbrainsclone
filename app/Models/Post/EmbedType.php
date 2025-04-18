<?php

namespace App\Models\Post;

enum EmbedType: string
{
    case YOUTUBE = 'youtube';
    case VIMEO = 'vimeo';

    /**
     * Get the label for the video embed type.
     */
    public function getLabel(): string
    {
        return $this->value;
    }

    /**
     * Get the icon for the video embed type.
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::YOUTUBE => '<i class="pr-1 fas fa-tag"></i>',
            self::VIMEO => '<i class="pr-1 fas fa-italic"></i>',
            default => throw new \Exception('Invalid tag type'),
        };
    }

    /**
     * Get the video embed type from a label.
     */
    public static function fromLabel(string $label): EmbedType
    {
        return match ($label) {
            self::YOUTUBE->value => self::YOUTUBE,
            self::VIMEO->value => self::VIMEO,
            default => throw new \Exception("Invalid tag type: $label"),
        };
    }
}
