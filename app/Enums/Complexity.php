<?php

declare(strict_types=1);

namespace App\Enums;

enum Complexity: int
{
    case Easy = 1;
    case Medium = 2;
    case Hard = 3;
    case UltraHard = 4;

    public static function getWord(self $complexity): string
    {
        return match ($complexity) {
            self::Easy => __('messages.easy'),
            self::Medium => __('messages.medium'),
            self::Hard => __('messages.hard'),
            self::UltraHard => __('messages.ultra_hard'),
        };
    }
}
