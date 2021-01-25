<?php 

namespace App\Tests\Model;

use App\Model\Game;

use App\Model\Piece\King;
use App\Model\Piece\Pawn;
use App\Model\Piece\Rook;

use PHPUnit\Framework\TestCase;

class MoveTypesTest extends TestCase 
{
    public function testDefaultMoveType()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);

        $this->assertEquals($game->getMoves()[0]['type'], 'default');
    }

    public function testCaptureMoveType()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 5]);
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 2]);
        $game->makeMove($game->getBoard()[8][6]->getPiece(), [3, 1]);

        $this->assertEquals($game->getMoves()[3]['type'], 'capture');
    }

    public function testCheckMoveType()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [3, 6]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 5]);
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 2]);
        $game->makeMove($game->getBoard()[8][4]->getPiece(), [4, 8]);

        $this->assertEquals($game->getMoves()[3]['type'], 'check');
    }

    public function testPromotionMoveType()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[7][6]->setPiece(new King('SOPEDF', [7, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'white'));

        $game->makeMove($game->getBoard()[7][1]->getPiece(), [8, 1]);

        $this->assertEquals($game->getMoves()[0]['type'], 'promotion');
    }

    public function testPromotionWithCheckMoveType()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'white'));

        $game->makeMove($game->getBoard()[7][1]->getPiece(), [8, 1]);

        $this->assertEquals($game->getMoves()[0]['type'], 'promotion_with_check');
    }

    public function testPromotionWithCaptureMoveType()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[7][6]->setPiece(new King('SOPEDF', [7, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'white'));

        $game->makeMove($game->getBoard()[7][1]->getPiece(), [8, 1]);

        $this->assertEquals($game->getMoves()[0]['type'], 'promotion_with_capture');
    }

    public function testPromotionWithCaptureAndCheckMoveType()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'white'));

        $game->makeMove($game->getBoard()[7][1]->getPiece(), [8, 1]);

        $this->assertEquals($game->getMoves()[0]['type'], 'promotion_with_capture_and_check');
    }

    public function testShortCastle()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('POUJ6V', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('SDF25B', [1, 5], 'white'));

        $game->getBoard()[1][8]->setPiece(new Rook('57VBD3', [1, 8], 'white'));

        $game->makeMove($game->getBoard()[1][5]->getPiece(), [['from' => [1, 5], 'to' => [1, 7]], ['from' => [1, 8], 'to' => [1, 6]]]);

        $this->assertEquals($game->getMoves()[0]['type'], 'short_castle');
    }

    public function testLongCastle()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][8]->setPiece(new King('POUJ6V', [8, 8], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('SDF25B', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('57VBD3', [1, 1], 'white'));

        $game->makeMove($game->getBoard()[1][5]->getPiece(), [['from' => [1, 5], 'to' => [1, 3]], ['from' => [1, 1], 'to' => [1, 4]]]);

        $this->assertEquals($game->getMoves()[0]['type'], 'long_castle');
    }

    public function testShortCastleWithCheck()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('POUJ6V', [8, 6], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('SDF25B', [1, 5], 'white'));

        $game->getBoard()[1][8]->setPiece(new Rook('57VBD3', [1, 8], 'white'));

        $game->makeMove($game->getBoard()[1][5]->getPiece(), [['from' => [1, 5], 'to' => [1, 7]], ['from' => [1, 8], 'to' => [1, 6]]]);

        $this->assertEquals($game->getMoves()[0]['type'], 'short_castle_with_check');
    }

    public function testSLongCastleWithCheck()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][4]->setPiece(new King('POUJ6V', [8, 4], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('SDF25B', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('57VBD3', [1, 1], 'white'));

        $game->makeMove($game->getBoard()[1][5]->getPiece(), [['from' => [1, 5], 'to' => [1, 3]], ['from' => [1, 1], 'to' => [1, 4]]]);

        $this->assertEquals($game->getMoves()[0]['type'], 'long_castle_with_check');
    }
}