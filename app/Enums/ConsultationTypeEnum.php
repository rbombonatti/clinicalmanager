<?php

namespace App\Enums;

enum ConsultationTypeEnum: String
{
    case CONSULTA = 'Consulta';
    case CIRURGIA = 'Cirurgia';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
