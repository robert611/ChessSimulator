<?php

declare(strict_types=1);

namespace App\Dictionary;

enum Coord
{
    case A1;
    case A2;
    case A3;
    case A4;
    case A5;
    case A6;
    case A7;
    case A8;
    case B1;
    case B2;
    case B3;
    case B4;
    case B5;
    case B6;
    case B7;
    case B8;
    case C1;
    case C2;
    case C3;
    case C4;
    case C5;
    case C6;
    case C7;
    case C8;
    case D1;
    case D2;
    case D3;
    case D4;
    case D5;
    case D6;
    case D7;
    case D8;
    case E1;
    case E2;
    case E3;
    case E4;
    case E5;
    case E6;
    case E7;
    case E8;
    case F1;
    case F2;
    case F3;
    case F4;
    case F5;
    case F6;
    case F7;
    case F8;
    case G1;
    case G2;
    case G3;
    case G4;
    case G5;
    case G6;
    case G7;
    case G8;
    case H1;
    case H2;
    case H3;
    case H4;
    case H5;
    case H6;
    case H7;
    case H8;
    case WHITE_SHORT_CASTLE;
    case WHITE_LONG_CASTLE;
    case BLACK_SHORT_CASTLE;
    case BLACK_LONG_CASTLE;

    public function toArray(): array
    {
        return match ($this) {
            self::A1 => [1, 1],
            self::A2 => [2, 1],
            self::A3 => [3, 1],
            self::A4 => [4, 1],
            self::A5 => [5, 1],
            self::A6 => [6, 1],
            self::A7 => [7, 1],
            self::A8 => [8, 1],
            self::B1 => [1, 2],
            self::B2 => [2, 2],
            self::B3 => [3, 2],
            self::B4 => [4, 2],
            self::B5 => [5, 2],
            self::B6 => [6, 2],
            self::B7 => [7, 2],
            self::B8 => [8, 2],
            self::C1 => [1, 3],
            self::C2 => [2, 3],
            self::C3 => [3, 3],
            self::C4 => [4, 3],
            self::C5 => [5, 3],
            self::C6 => [6, 3],
            self::C7 => [7, 3],
            self::C8 => [8, 3],
            self::D1 => [1, 4],
            self::D2 => [2, 4],
            self::D3 => [3, 4],
            self::D4 => [4, 4],
            self::D5 => [5, 4],
            self::D6 => [6, 4],
            self::D7 => [7, 4],
            self::D8 => [8, 4],
            self::E1 => [1, 5],
            self::E2 => [2, 5],
            self::E3 => [3, 5],
            self::E4 => [4, 5],
            self::E5 => [5, 5],
            self::E6 => [6, 5],
            self::E7 => [7, 5],
            self::E8 => [8, 5],
            self::F1 => [1, 6],
            self::F2 => [2, 6],
            self::F3 => [3, 6],
            self::F4 => [4, 6],
            self::F5 => [5, 6],
            self::F6 => [6, 6],
            self::F7 => [7, 6],
            self::F8 => [8, 6],
            self::G1 => [1, 7],
            self::G2 => [2, 7],
            self::G3 => [3, 7],
            self::G4 => [4, 7],
            self::G5 => [5, 7],
            self::G6 => [6, 7],
            self::G7 => [7, 7],
            self::G8 => [8, 7],
            self::H1 => [1, 8],
            self::H2 => [2, 8],
            self::H3 => [3, 8],
            self::H4 => [4, 8],
            self::H5 => [5, 8],
            self::H6 => [6, 8],
            self::H7 => [7, 8],
            self::H8 => [8, 8],
            self::WHITE_SHORT_CASTLE => [['from' => [1, 5], 'to' => [1, 7]], ['from' => [1, 8], 'to' => [1, 6]]],
            self::WHITE_LONG_CASTLE => [['from' => [1, 5], 'to' => [1, 3]], ['from' => [1, 1], 'to' => [1, 4]]],
            self::BLACK_SHORT_CASTLE => [['from' => [8, 5], 'to' => [8, 7]], ['from' => [8, 8], 'to' => [8, 6]]],
            self::BLACK_LONG_CASTLE => [['from' => [8, 5], 'to' => [8, 3]], ['from' => [8, 1], 'to' => [8, 4]]],
        };
    }

    public function isCastleMove(): bool
    {
        if ($this === self::WHITE_SHORT_CASTLE) {
            return true;
        }

        if ($this === self::WHITE_LONG_CASTLE) {
            return true;
        }

        if ($this === self::BLACK_SHORT_CASTLE) {
            return true;
        }

        if ($this === self::BLACK_LONG_CASTLE) {
            return true;
        }

        return false;
    }
}
