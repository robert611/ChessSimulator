<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Board;
use App\Model\Piece\Rook;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    #[Test]
    public function it_returns_board_in_numerical_notation(): void
    {
        // given
        $board = new Board();

        // when
        $result = $board->getBoardInNumericalNotation();

        // then
        self::assertInstanceOf(Rook::class, $result[1][1]->getPiece());
    }
}
