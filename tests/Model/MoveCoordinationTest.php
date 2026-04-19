<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Game;
use PHPUnit\Framework\TestCase;

class MoveCoordinationTest extends TestCase
{
    public function testIfPawnMoveCoordinationAreCorrect(): void
    {
        // given
        $game = new Game();

        // when
        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);

        // then
        $this->assertEquals([2, 1], $game->getMoves()[0]['previous_cords']);
        $this->assertEquals([3, 1], $game->getMoves()[0]['new_cords_square']->getCords());
        $this->assertEquals([3, 1], $game->getBoard()[3][1]->getPiece()->getCords());
    }

    public function testIfKnightMoveCoordinationAreCorrect(): void
    {
        // given
        $game = new Game();

        // when
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);

        // then
        $this->assertEquals([1, 2], $game->getMoves()[0]['previous_cords']);
        $this->assertEquals([3, 3], $game->getMoves()[0]['new_cords_square']->getCords());
        $this->assertEquals([3, 3], $game->getBoard()[3][3]->getPiece()->getCords());
    }

    public function testIfBishopMoveCoordinationAreCorrect(): void
    {
        // given
        $game = new Game();

        // when
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 2]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][3]->getPiece(), [2, 2]);

        // then
        $this->assertEquals([1, 3], $game->getMoves()[2]['previous_cords']);
        $this->assertEquals([2, 2], $game->getMoves()[2]['new_cords_square']->getCords());
        $this->assertEquals([2, 2], $game->getBoard()[2][2]->getPiece()->getCords());
    }

    public function testIfRookMoveCoordinationAreCorrect(): void
    {
        // given
        $game = new Game();

        // when
        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][1]->getPiece(), [2, 1]);

        // then
        $this->assertEquals([1, 1], $game->getMoves()[2]['previous_cords']);
        $this->assertEquals([2, 1], $game->getMoves()[2]['new_cords_square']->getCords());
        $this->assertEquals([2, 1], $game->getBoard()[2][1]->getPiece()->getCords());
    }

    public function testIfQueenMoveCoordinationAreCorrect(): void
    {
        // given
        $game = new Game();

        // when
        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][4]->getPiece(), [4, 1]);

        // then
        $this->assertEquals([7, 1], $game->getMoves()[1]['previous_cords']);
        $this->assertEquals([6, 1], $game->getMoves()[1]['new_cords_square']->getCords());
        $this->assertEquals([6, 1], $game->getBoard()[6][1]->getPiece()->getCords());

        // and then
        $this->assertEquals([1, 4], $game->getMoves()[2]['previous_cords']);
        $this->assertEquals([4, 1], $game->getMoves()[2]['new_cords_square']->getCords());
        $this->assertEquals([4, 1], $game->getBoard()[4][1]->getPiece()->getCords());
    }

    public function testIfKingMoveCoordinationAreCorrect(): void
    {
        // given
        $game = new Game();

        // when
        $game->makeMove($game->getBoard()[2][5]->getPiece(), [3, 5]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][5]->getPiece(), [2, 5]);

        // then
        $this->assertEquals([1, 5], $game->getMoves()[2]['previous_cords']);
        $this->assertEquals([2, 5], $game->getMoves()[2]['new_cords_square']->getCords());
        $this->assertEquals([2, 5], $game->getBoard()[2][5]->getPiece()->getCords());
    }
}
