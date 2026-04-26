<?php

declare(strict_types=1);

namespace App\Tests\Dictionary;

use App\Dictionary\Coord;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CoordTest extends TestCase
{
    #[Test]
    public function it_recognizes_if_move_is_of_type_castle(): void
    {
        self::assertTrue(Coord::WHITE_SHORT_CASTLE->isCastleMove());
        self::assertTrue(Coord::WHITE_LONG_CASTLE->isCastleMove());
        self::assertTrue(Coord::BLACK_SHORT_CASTLE->isCastleMove());
        self::assertTrue(Coord::BLACK_LONG_CASTLE->isCastleMove());
        self::assertFalse(Coord::A1->isCastleMove());
        self::assertFalse(Coord::D4->isCastleMove());
        self::assertFalse(Coord::H8->isCastleMove());
    }
}
