<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum RoomTypesEnum: string
{
    case Single = 'single';
    case Double = 'double';
    case Triple = 'triple';
    case Family = 'family';
    case Studio = 'studio';

    public static function collection(): Collection
    {
        return collect(self::cases());
    }
}
