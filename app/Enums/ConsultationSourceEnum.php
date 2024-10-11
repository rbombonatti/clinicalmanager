<?php

namespace App\Enums;

enum ConsultationSourceEnum: String
{
    case EQUIPE = 'Equipe';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
