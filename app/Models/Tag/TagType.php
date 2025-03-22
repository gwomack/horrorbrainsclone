<?php

namespace App\Models\Tag;

enum TagType {
    case Tag;
    case Input;
    case Actor;
    case Director;
    case Writer;
    case Producer;
    case Cinematographer;
    case Editor;
    case Composer;
    case Sound;

    public function getLabel(): string
    {
        return match ($this) {
            self::Tag => 'tag',
            self::Input => 'input',
            default => throw new \Exception("Invalid tag type"),
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Tag => '<i class="pr-1 fas fa-tag"></i>',
            self::Input => '<i class="pr-1 fas fa-italic"></i>',
            default => throw new \Exception("Invalid tag type"),
        };
    }

    public static function fromLabel(string $label): TagType
    {
        return match ($label) {
            'tag' => self::Tag,
            'input' => self::Input,
            default => throw new \Exception("Invalid tag type: $label"),
        };
    }
}
