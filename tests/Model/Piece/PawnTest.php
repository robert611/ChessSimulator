<?php 

namespace App\Tests\Model;

use App\Model\Piece\Rook;
use App\Model\Piece\Quenn;
use App\Model\Piece\Bishop;
use App\Model\Piece\King;
use App\Model\Piece\Knight;
use App\Model\Piece\Pawn;
use App\Model\Board;
use App\Model\Game;

use PHPUnit\Framework\TestCase;

class PawnTest extends TestCase
{
    public function testIfPawnIsPromotedToAQuennDuringTheGame()
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

        $this->assertTrue($game->getBoard()[8][1]->getPiece() instanceof Quenn);

        $gameWithCaptureAndPromotion = new Game();

        $board = $gameWithCaptureAndPromotion->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $gameWithCaptureAndPromotion->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $gameWithCaptureAndPromotion->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $gameWithCaptureAndPromotion->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $gameWithCaptureAndPromotion->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'white'));
        $gameWithCaptureAndPromotion->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [7, 1], 'black'));

        $gameWithCaptureAndPromotion->makeMove($gameWithCaptureAndPromotion->getBoard()[7][1]->getPiece(), [8, 1]);

        $this->assertTrue($gameWithCaptureAndPromotion->getBoard()[8][1]->getPiece() instanceof Quenn);
    }
}