<?php 

namespace App\Tests\Model;

use App\Model\Game;
use PHPUnit\Framework\TestCase;

class MoveCoordinationsTest extends TestCase
{
    public function testIfPawnMoveCoordinationsAreCorrect()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);

        $this->assertEquals($game->getMoves()[0]['previous_cords'], [2, 1]);
        $this->assertEquals($game->getMoves()[0]['new_cords_square']->getCords(), [3, 1]);
        $this->assertEquals($game->getBoard()[3][1]->getPiece()->getCords(), [3, 1]);
    }

    public function testIfKnightMoveCoordinationsAreCorrect()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);

        $this->assertEquals($game->getMoves()[0]['previous_cords'], [1, 2]);
        $this->assertEquals($game->getMoves()[0]['new_cords_square']->getCords(), [3, 3]);
        $this->assertEquals($game->getBoard()[3][3]->getPiece()->getCords(), [3, 3]);
    }

    public function testIfBishopMoveCoordinationsAreCorrect()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 2]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][3]->getPiece(), [2, 2]);

        $this->assertEquals($game->getMoves()[2]['previous_cords'], [1, 3]);
        $this->assertEquals($game->getMoves()[2]['new_cords_square']->getCords(), [2, 2]);
        $this->assertEquals($game->getBoard()[2][2]->getPiece()->getCords(), [2, 2]);
    }

    public function testIfRookMoveCoordinationsAreCorrect()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][1]->getPiece(), [2, 1]);

        $this->assertEquals($game->getMoves()[2]['previous_cords'], [1, 1]);
        $this->assertEquals($game->getMoves()[2]['new_cords_square']->getCords(), [2, 1]);
        $this->assertEquals($game->getBoard()[2][1]->getPiece()->getCords(), [2, 1]);
    }

    public function testIfQuennMoveCoordinationsAreCorrect()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][4]->getPiece(), [4, 1]);

        $this->assertEquals($game->getMoves()[1]['previous_cords'], [7, 1]);
        $this->assertEquals($game->getMoves()[1]['new_cords_square']->getCords(), [6, 1]);
        $this->assertEquals($game->getBoard()[6][1]->getPiece()->getCords(), [6, 1]);

        $this->assertEquals($game->getMoves()[2]['previous_cords'], [1, 4]);
        $this->assertEquals($game->getMoves()[2]['new_cords_square']->getCords(), [4, 1]);
        $this->assertEquals($game->getBoard()[4][1]->getPiece()->getCords(), [4, 1]);
    }

    public function testIfKingennMoveCoordinationsAreCorrect()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][5]->getPiece(), [3, 5]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[1][5]->getPiece(), [2, 5]);

        $this->assertEquals($game->getMoves()[2]['previous_cords'], [1, 5]);
        $this->assertEquals($game->getMoves()[2]['new_cords_square']->getCords(), [2, 5]);
        $this->assertEquals($game->getBoard()[2][5]->getPiece()->getCords(), [2, 5]);
    }
}