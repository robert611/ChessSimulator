<?php

declare(strict_types=1);

namespace App\Dictionary;

enum PieceColor: string
{
    case WHITE = 'WHITE';
    case BLACK = 'BLACK';

    public static function getOpponentSide(string $side): string
    {
        if (strtoupper($side) === self::WHITE->value) {
            return self::BLACK->value;
        }

        return self::WHITE->value;
    }
}
