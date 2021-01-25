<?php 

namespace App\Tests\Model\King;

use App\Model\Board;
use App\Model\Game;
use App\Model\Piece\Rook;
use App\Model\Piece\Quenn;
use App\Model\Piece\Bishop;
use App\Model\Piece\King;
use App\Model\Piece\Knight;
use App\Model\Piece\Pawn;

use PHPUnit\Framework\TestCase;

class CheckIfKingIsInCheckmateTest extends TestCase
{
    public function testIfKingIsInCheckmate()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        $correctSet[0]['king'] = $game->getBoard()[8][6]->getPiece();
        $correctSet[0]['game'] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[5][1]->setPiece(new King('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[4][3]->setPiece(new King('SOPEDF', [4, 3], 'white'));

        $game->getBoard()[5][2]->setPiece(new Quenn('SOPEDF', [5, 2], 'white'));
        
        $correctSet[1]['king'] = $game->getBoard()[5][1]->getPiece();
        $correctSet[1]['game'] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        $game->getBoard()[1][7]->setPiece(new King('SOPEDF', [1, 7], 'white'));

        $game->getBoard()[7][6]->setPiece(new Pawn('SOPEDF', [7, 6], 'black'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'black'));
        $game->getBoard()[6][8]->setPiece(new Pawn('SOPEDF', [6, 8], 'black'));

        $game->getBoard()[2][6]->setPiece(new Pawn('SOPEDF', [2, 6], 'white'));
        $game->getBoard()[2][7]->setPiece(new Pawn('SOPEDF', [2, 7], 'white'));
        $game->getBoard()[3][8]->setPiece(new Pawn('SOPEDF', [3, 8], 'white'));

        $game->getBoard()[3][4]->setPiece(new Bishop('SOPEDF', [3, 4], 'white'));
        $game->getBoard()[3][3]->setPiece(new Knight('SOPEDF', [3, 3], 'black'));
        $game->getBoard()[2][2]->setPiece(new Rook('SOPEDF', [2, 2], 'black'));

        $game->getBoard()[8][4]->setPiece(new Rook('SOPEDF', [8, 4], 'white'));

        $correctSet[2]['king'] = $game->getBoard()[8][7]->getPiece();
        $correctSet[2]['game'] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[5][5]->setPiece(new King('SOPEDF', [5, 5], 'black'));
        $game->getBoard()[1][7]->setPiece(new King('SOPEDF', [1, 7], 'white'));

        $game->getBoard()[4][5]->setPiece(new Pawn('SOPEDF', [4, 5], 'white'));
        $game->getBoard()[3][5]->setPiece(new Pawn('SOPEDF', [3, 5], 'white'));

        $game->getBoard()[5][4]->setPiece(new Bishop('SOPEDF', [5, 4], 'white'));
        $game->getBoard()[6][6]->setPiece(new Bishop('SOPEDF', [6, 6], 'white'));
        $game->getBoard()[8][5]->setPiece(new Knight('SOPEDF', [8, 5], 'white'));

        $correctSet[3]['king'] = $game->getBoard()[5][5]->getPiece();
        $correctSet[3]['game'] = $game;

        /* Position 5 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'black'));
        $game->getBoard()[1][6]->setPiece(new King('SOPEDF', [1, 6], 'white'));

        $game->getBoard()[4][4]->setPiece(new Bishop('SOPEDF', [4, 4], 'white'));
        $game->getBoard()[7][6]->setPiece(new Bishop('SOPEDF', [7, 6], 'white'));

        $game->getBoard()[7][8]->setPiece(new Pawn('SOPEDF', [7, 8], 'black'));

        $correctSet[4]['king'] = $game->getBoard()[8][8]->getPiece();
        $correctSet[4]['game'] = $game;

        /* Position 6 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        $game->getBoard()[1][8]->setPiece(new King('SOPEDF', [1, 8], 'white'));

        /* Pawns */
        $game->getBoard()[2][1]->setPiece(new Pawn('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[2][6]->setPiece(new Pawn('SOPEDF', [2, 6], 'white'));
        $game->getBoard()[2][8]->setPiece(new Pawn('SOPEDF', [2, 8], 'white'));
        $game->getBoard()[3][6]->setPiece(new Pawn('SOPEDF', [3, 6], 'white'));
        $game->getBoard()[4][5]->setPiece(new Pawn('SOPEDF', [4, 5], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'black'));
        $game->getBoard()[7][2]->setPiece(new Pawn('SOPEDF', [7, 2], 'black'));
        $game->getBoard()[7][6]->setPiece(new Pawn('SOPEDF', [7, 6], 'black'));
        $game->getBoard()[7][8]->setPiece(new Pawn('SOPEDF', [7, 8], 'black'));
        $game->getBoard()[6][4]->setPiece(new Pawn('SOPEDF', [6, 4], 'black'));
        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Rooks */
        $game->getBoard()[5][7]->setPiece(new Rook('SOPEDF', [5, 7], 'white'));
        $game->getBoard()[8][3]->setPiece(new Rook('SOPEDF', [8, 3], 'black'));
        $game->getBoard()[8][6]->setPiece(new Rook('SOPEDF', [8, 6], 'black'));
        
        /* Knights */
        $game->getBoard()[2][5]->setPiece(new Knight('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[4][3]->setPiece(new Knight('SOPEDF', [4, 3], 'black'));
        
        /* Bishops */
        $game->getBoard()[2][2]->setPiece(new Bishop('SOPEDF', [2, 2], 'white'));
        $game->getBoard()[4][4]->setPiece(new Bishop('SOPEDF', [4, 4], 'white'));
        $game->getBoard()[6][2]->setPiece(new Bishop('SOPEDF', [6, 2], 'black'));

        $correctSet[5]['king'] = $game->getBoard()[8][7]->getPiece();
        $correctSet[5]['game'] = $game;

        /* Position 7 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        $game->getBoard()[1][8]->setPiece(new King('SOPEDF', [1, 8], 'white'));

        /* Rooks */
        $game->getBoard()[5][7]->setPiece(new Rook('SOPEDF', [5, 7], 'white'));
        $game->getBoard()[8][3]->setPiece(new Rook('SOPEDF', [8, 3], 'white'));
        $game->getBoard()[7][3]->setPiece(new Rook('SOPEDF', [7, 3], 'white'));
        
        /* Bishops */
        $game->getBoard()[4][4]->setPiece(new Bishop('SOPEDF', [4, 4], 'white'));
        $game->getBoard()[6][7]->setPiece(new Bishop('SOPEDF', [6, 7], 'black'));
        $game->getBoard()[6][2]->setPiece(new Bishop('SOPEDF', [6, 2], 'black'));

        $correctSet[6]['king'] = $game->getBoard()[8][7]->getPiece();
        $correctSet[6]['game'] = $game;

        foreach ($correctSet as $position)
        {
            $isInCheckmate = $position['king']->checkIfKingIsInCheckmate($position['game']);
            $this->assertTrue($isInCheckmate);
        }
    }

    public function testIfKingIsNotInCheckmate()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][2]->setPiece(new King('SOPEDF', [8, 2], 'black'));
        $game->getBoard()[6][2]->setPiece(new King('SOPEDF', [6, 2], 'white'));

        $game->getBoard()[8][3]->setPiece(new Quenn('SOPEDF', [8, 3], 'white'));
        $game->getBoard()[7][2]->setPiece(new Pawn('SOPEDF', [7, 2], 'black'));
        
        $wrongSet[0]['king'] = $game->getBoard()[8][2]->getPiece();
        $wrongSet[0]['game'] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[6][5]->setPiece(new King('SOPEDF', [6, 5], 'white'));

        $game->getBoard()[6][4]->setPiece(new Quenn('SOPEDF', [6, 4], 'white'));
        
        $wrongSet[1]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[1]['game'] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'black'));
        $game->getBoard()[2][4]->setPiece(new King('SOPEDF', [2, 4], 'white'));

        /* Pawns */
        $game->getBoard()[2][1]->setPiece(new Pawn('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[2][2]->setPiece(new Pawn('SOPEDF', [2, 2], 'white'));
        $game->getBoard()[2][3]->setPiece(new Pawn('SOPEDF', [2, 3], 'white'));
        $game->getBoard()[5][6]->setPiece(new Pawn('SOPEDF', [5, 6], 'white'));
        $game->getBoard()[6][5]->setPiece(new Pawn('SOPEDF', [6, 5], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'black'));
        $game->getBoard()[7][2]->setPiece(new Pawn('SOPEDF', [7, 2], 'black'));
        $game->getBoard()[6][3]->setPiece(new Pawn('SOPEDF', [6, 3], 'black'));
        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'black'));

        /* Rooks */
        $game->getBoard()[1][7]->setPiece(new Rook('SOPEDF', [1, 7], 'white'));
        $game->getBoard()[6][8]->setPiece(new Rook('SOPEDF', [6, 8], 'white'));
        $game->getBoard()[7][5]->setPiece(new Rook('SOPEDF', [7, 5], 'black'));
        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'black'));
        
        /* Knights */
        $game->getBoard()[6][6]->setPiece(new Knight('SOPEDF', [6, 6], 'white'));
        $game->getBoard()[7][8]->setPiece(new Knight('SOPEDF', [7, 8], 'black'));

        $wrongSet[2]['king'] = $game->getBoard()[8][8]->getPiece();
        $wrongSet[2]['game'] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        $game->getBoard()[1][8]->setPiece(new King('SOPEDF', [1, 8], 'white'));

        /* Pawns */
        $game->getBoard()[2][1]->setPiece(new Pawn('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[2][6]->setPiece(new Pawn('SOPEDF', [2, 6], 'white'));
        $game->getBoard()[2][8]->setPiece(new Pawn('SOPEDF', [2, 8], 'white'));
        $game->getBoard()[3][6]->setPiece(new Pawn('SOPEDF', [3, 6], 'white'));
        $game->getBoard()[4][5]->setPiece(new Pawn('SOPEDF', [4, 5], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'black'));
        $game->getBoard()[7][2]->setPiece(new Pawn('SOPEDF', [7, 2], 'black'));
        $game->getBoard()[7][6]->setPiece(new Pawn('SOPEDF', [7, 6], 'black'));
        $game->getBoard()[7][8]->setPiece(new Pawn('SOPEDF', [7, 8], 'black'));
        $game->getBoard()[6][4]->setPiece(new Pawn('SOPEDF', [6, 4], 'black'));
        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Rooks */
        $game->getBoard()[1][7]->setPiece(new Rook('SOPEDF', [1, 7], 'white'));
        $game->getBoard()[8][3]->setPiece(new Rook('SOPEDF', [8, 3], 'black'));
        $game->getBoard()[8][6]->setPiece(new Rook('SOPEDF', [8, 6], 'black'));
        
        /* Knights */
        $game->getBoard()[2][5]->setPiece(new Knight('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[4][3]->setPiece(new Knight('SOPEDF', [4, 3], 'black'));
        
        /* Bishops */
        $game->getBoard()[2][2]->setPiece(new Bishop('SOPEDF', [2, 2], 'white'));
        $game->getBoard()[4][4]->setPiece(new Bishop('SOPEDF', [4, 4], 'white'));
        $game->getBoard()[6][2]->setPiece(new Bishop('SOPEDF', [6, 2], 'black'));

        /* Queen */
        $game->getBoard()[5][7]->setPiece(new Quenn('SOPEDF', [5, 7], 'black'));

        $wrongSet[3]['king'] = $game->getBoard()[8][7]->getPiece();
        $wrongSet[3]['game'] = $game;

        /* Position 5 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Rooks */
        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Knight */
        $game->getBoard()[1][1]->setPiece(new Rook('SOPEDF', [1, 1], 'black'));

        $wrongSet[4]['king'] = $game->getBoard()[8][6]->getPiece();
        $wrongSet[4]['game'] = $game;

        foreach ($wrongSet as $position)
        {
            $isInCheckmate = $position['king']->checkIfKingIsInCheckmate($position['game']);
            $this->assertFalse($isInCheckmate);
        }
    }

    public function checkIfKingIsNotInCheckmateBecauseCheckCanBeBlocked()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Rooks */
        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Knight */
        $game->getBoard()[6][6]->setPiece(new Knight('SOPEDF', [6, 6], 'black'));

        $wrongSet[0]['king'] = $game->getBoard()[8][6]->getPiece();
        $wrongSet[0]['game'] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Rooks && Queens */
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Bishop */
        $game->getBoard()[5][1]->setPiece(new Bishop('SOPEDF', [5, 1], 'black'));

        $wrongSet[1]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[1]['game'] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Pawns */
        $game->getBoard()[6][2]->setPiece(new Pawn('SOPEDF', [6, 2], 'black'));


        /* Rooks && Queens */
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Bishop */
        $game->getBoard()[5][1]->setPiece(new Bishop('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[4][8]->setPiece(new Bishop('SOPEDF', [4, 8], 'black'));
 
        $wrongSet[2]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[2]['game'] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Pawns */
        $game->getBoard()[6][2]->setPiece(new Pawn('SOPEDF', [6, 2], 'black'));


        /* Rooks && Queens */
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[8][7]->setPiece(new Quenn('SOPEDF', [8, 7], 'white'));

        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));
        $game->getBoard()[8][4]->setPiece(new Rook('SOPEDF', [8, 4], 'black'));
        $game->getBoard()[1][6]->setPiece(new Rook('SOPEDF', [1, 6], 'black'));

        /* Bishop */
        $game->getBoard()[5][1]->setPiece(new Bishop('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[4][8]->setPiece(new Bishop('SOPEDF', [4, 8], 'black'));
 
        $wrongSet[3]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[3]['game'] = $game;

        foreach ($wrongSet as $position)
        {
            $isInCheckmate = $position['king']->checkIfKingIsInCheckmate($position['game']);
            $this->assertFalse($isInCheckmate);
        }
    }
}