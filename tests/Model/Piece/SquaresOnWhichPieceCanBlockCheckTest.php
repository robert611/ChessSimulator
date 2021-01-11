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

class SquaresOnWhichPieceCanBlockCheckTest extends TestCase
{
    public function testIfSquaresOnWhichPieceCanBlockCheckOnHorizontalColumnAreCorrect()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[1][3]->setPiece(new King('SOPEDF', [1, 3], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        /* Pawns */
        $game->getBoard()[3][1]->setPiece(new Pawn('SOPEDF', [3, 1], 'white'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'white'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'white'));

        $game->getBoard()[4][3]->setPiece(new Pawn('SOPEDF', [4, 3], 'black'));
        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Bishops */
        $game->getBoard()[5][6]->setPiece(new Bishop('SOPEDF', [5, 6], 'black'));

        /* Knights */
        $game->getBoard()[2][4]->setPiece(new Knight('SOPEDF', [2, 4], 'white'));
        $game->getBoard()[7][3]->setPiece(new Knight('SOPEDF', [7, 3], 'white'));

        $game->getBoard()[4][8]->setPiece(new Knight('SOPEDF', [4, 8], 'black'));

        /* Rooks */
        $game->getBoard()[2][1]->setPiece(new Rook('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[8][5]->setPiece(new Rook('SOPEDF', [8, 5], 'black'));

        /* Queens */
        $game->getBoard()[2][5]->setPiece(new Quenn('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));

        $game->getBoard()[4][2]->setPiece(new Quenn('SOPEDF', [4, 2], 'black'));
        $game->getBoard()[1][7]->setPiece(new Quenn('SOPEDF', [1, 7], 'black'));

        $squares = $game->getBoard()[1][3]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([1, 3], [1, 7]);
        sort($squares);

        $expectedSquares = [[1, 6], [1, 5], [1, 4]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 2 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[3][2]->setPiece(new King('SOPEDF', [3, 2], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        $game->getBoard()[3][8]->setPiece(new Rook('SOPEDF', [3, 8], 'black'));

        $squares = $game->getBoard()[3][2]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([3, 2], [3, 8]);
        sort($squares);

        $expectedSquares = [[3, 3], [3, 4], [3, 5], [3, 6], [3, 7]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 3 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[3][8]->setPiece(new King('SOPEDF', [3, 8], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        $game->getBoard()[3][1]->setPiece(new Rook('SOPEDF', [3, 1], 'black'));

        $squares = $game->getBoard()[3][8]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([3, 8], [3, 1]);
        sort($squares);

        $expectedSquares = [[3, 2], [3, 3], [3, 4], [3, 5], [3, 6], [3, 7]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
    }

    public function testIfSquaresOnWhichPieceCanBlockCheckOnVerticalColumnAreCorrect()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[1][3]->setPiece(new King('SOPEDF', [1, 3], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        /* Pawns */
        $game->getBoard()[3][1]->setPiece(new Pawn('SOPEDF', [3, 1], 'white'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'white'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'white'));

        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Bishops */
        $game->getBoard()[5][6]->setPiece(new Bishop('SOPEDF', [5, 6], 'black'));

        /* Knights */
        $game->getBoard()[2][4]->setPiece(new Knight('SOPEDF', [2, 4], 'white'));
        $game->getBoard()[7][3]->setPiece(new Knight('SOPEDF', [7, 3], 'white'));

        $game->getBoard()[4][8]->setPiece(new Knight('SOPEDF', [4, 8], 'black'));

        /* Queens */
        $game->getBoard()[2][5]->setPiece(new Quenn('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));

        $game->getBoard()[4][2]->setPiece(new Quenn('SOPEDF', [4, 2], 'black'));
        $game->getBoard()[4][3]->setPiece(new Quenn('SOPEDF', [4, 3], 'black'));

        $squares = $game->getBoard()[1][3]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([1, 3], [4, 3]);
        sort($squares);

        $expectedSquares = [[2, 3], [3, 3]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 2 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[5][2]->setPiece(new King('SOPEDF', [5, 2], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        
        $game->getBoard()[8][2]->setPiece(new Rook('SOPEDF', [8, 2], 'black'));
        
        $squares = $game->getBoard()[5][2]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([5, 2], [8, 2]);
        sort($squares);

        $expectedSquares = [[6, 2], [7, 2]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 3 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[5][2]->setPiece(new King('SOPEDF', [5, 2], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        
        $game->getBoard()[1][2]->setPiece(new Rook('SOPEDF', [1, 2], 'black'));
        
        $squares = $game->getBoard()[5][2]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([5, 2], [1, 2]);
        sort($squares);

        $expectedSquares = [[2, 2], [3, 2], [4, 2]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
    }

    public function testIfSquaresOnWhichPieceCanBlockCheckOnUpLeftDiagonalColumnAreCorrect()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[1][3]->setPiece(new King('SOPEDF', [1, 3], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        /* Pawns */
        $game->getBoard()[3][1]->setPiece(new Pawn('SOPEDF', [3, 1], 'white'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'white'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'white'));

        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Bishops */
        $game->getBoard()[5][6]->setPiece(new Bishop('SOPEDF', [5, 6], 'black'));

        /* Knights */
        $game->getBoard()[2][4]->setPiece(new Knight('SOPEDF', [2, 4], 'white'));
        $game->getBoard()[7][3]->setPiece(new Knight('SOPEDF', [7, 3], 'white'));

        $game->getBoard()[4][8]->setPiece(new Knight('SOPEDF', [4, 8], 'black'));

        /* Queens */
        $game->getBoard()[2][5]->setPiece(new Quenn('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));

        $game->getBoard()[4][2]->setPiece(new Quenn('SOPEDF', [4, 2], 'black'));
        $game->getBoard()[3][1]->setPiece(new Quenn('SOPEDF', [3, 1], 'black'));

        $squares = $game->getBoard()[1][3]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([1, 3], [3, 1]);
        sort($squares);

        $expectedSquares = [[2, 2]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 2 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[3][5]->setPiece(new King('SOPEDF', [3, 5], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        
        $game->getBoard()[7][1]->setPiece(new Bishop('SOPEDF', [7, 1], 'black'));
        
        $squares = $game->getBoard()[3][5]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([3, 5], [7, 1]);
        sort($squares);

        $expectedSquares = [[6, 2], [5, 3], [4, 4]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 3 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[1][8]->setPiece(new King('SOPEDF', [1, 8], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'black'));
        
        $squares = $game->getBoard()[1][8]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([1, 8], [8, 1]);
        sort($squares);

        $expectedSquares = [[7, 2], [6, 3], [5, 4], [4, 5], [3, 6], [2, 7]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
    }

    public function testIfSquaresOnWhichPieceCanBlockCheckOnDownLeftDiagonalColumnAreCorrect()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[4][4]->setPiece(new King('SOPEDF', [4, 4], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        /* Pawns */
        $game->getBoard()[3][1]->setPiece(new Pawn('SOPEDF', [3, 1], 'white'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'white'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'white'));

        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Bishops */
        $game->getBoard()[5][6]->setPiece(new Bishop('SOPEDF', [5, 6], 'black'));

        /* Knights */
        $game->getBoard()[2][4]->setPiece(new Knight('SOPEDF', [2, 4], 'white'));
        $game->getBoard()[7][3]->setPiece(new Knight('SOPEDF', [7, 3], 'white'));

        $game->getBoard()[4][8]->setPiece(new Knight('SOPEDF', [4, 8], 'black'));

        /* Queens */
        $game->getBoard()[2][5]->setPiece(new Quenn('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));

        $game->getBoard()[1][1]->setPiece(new Quenn('SOPEDF', [1, 1], 'black'));

        $squares = $game->getBoard()[4][4]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([4, 4], [1, 1]);
        sort($squares);

        $expectedSquares = [[2, 2], [3, 3]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 2 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[7][5]->setPiece(new King('SOPEDF', [7, 5], 'white'));
        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'black'));
        
        $game->getBoard()[3][1]->setPiece(new Bishop('SOPEDF', [3, 1], 'black'));
        
        $squares = $game->getBoard()[7][5]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([3, 1], [7, 5]);
        sort($squares);

        $expectedSquares = [[4, 2], [5, 3], [6, 4]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 3 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[5][8]->setPiece(new King('SOPEDF', [5, 8], 'white'));
        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'black'));
        
        $game->getBoard()[1][4]->setPiece(new Quenn('SOPEDF', [1, 4], 'black'));
        
        $squares = $game->getBoard()[5][8]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([5, 8], [1, 4]);
        sort($squares);

        $expectedSquares = [[2, 5], [3, 6], [4, 7]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
    }

    public function testIfSquaresOnWhichPieceCanBlockCheckOnUpRightDiagonalColumnAreCorrect()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[1][2]->setPiece(new King('SOPEDF', [1, 2], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        /* Pawns */
        $game->getBoard()[3][1]->setPiece(new Pawn('SOPEDF', [3, 1], 'white'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'white'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'white'));

        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Bishops */
        $game->getBoard()[5][6]->setPiece(new Bishop('SOPEDF', [5, 6], 'black'));

        /* Knights */
        $game->getBoard()[2][4]->setPiece(new Knight('SOPEDF', [2, 4], 'white'));
        $game->getBoard()[7][3]->setPiece(new Knight('SOPEDF', [7, 3], 'white'));

        $game->getBoard()[4][8]->setPiece(new Knight('SOPEDF', [4, 8], 'black'));

        /* Queens */
        $game->getBoard()[2][5]->setPiece(new Quenn('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));

        $squares = $game->getBoard()[1][2]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([1, 2], [5, 6]);
        sort($squares);

        $expectedSquares = [[2, 3], [3, 4], [4, 5]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
        
        /* Position 2 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[4][2]->setPiece(new King('SOPEDF', [4, 2], 'black'));
        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'white'));
        
        $game->getBoard()[6][4]->setPiece(new Bishop('SOPEDF', [6, 4], 'white'));
        
        $squares = $game->getBoard()[4][2]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([4, 2], [6, 4]);
        sort($squares);

        $expectedSquares = [[5, 3]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 3 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[2][5]->setPiece(new King('SOPEDF', [2, 5], 'black'));
        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'white'));
        
        $game->getBoard()[5][8]->setPiece(new Bishop('SOPEDF', [5, 8], 'white'));
        
        $squares = $game->getBoard()[2][5]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([2, 5], [5, 8]);
        sort($squares);

        $expectedSquares = [[3, 6], [4, 7]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
    }

    public function testIfSquaresOnWhichPieceCanBlockCheckOnDownRightDiagonalColumnAreCorrect()
    {
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[6][2]->setPiece(new King('SOPEDF', [6, 2], 'white'));
        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));

        /* Pawns */
        $game->getBoard()[3][1]->setPiece(new Pawn('SOPEDF', [3, 1], 'white'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'white'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'white'));

        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Bishops */
        $game->getBoard()[5][6]->setPiece(new Bishop('SOPEDF', [5, 6], 'black'));
        $game->getBoard()[2][6]->setPiece(new Bishop('SOPEDF', [2, 6], 'black'));

        /* Knights */
        $game->getBoard()[2][4]->setPiece(new Knight('SOPEDF', [2, 4], 'white'));
        $game->getBoard()[7][3]->setPiece(new Knight('SOPEDF', [7, 3], 'white'));

        $game->getBoard()[4][8]->setPiece(new Knight('SOPEDF', [4, 8], 'black'));

        /* Queens */
        $game->getBoard()[8][1]->setPiece(new Quenn('SOPEDF', [8, 1], 'white'));

        $squares = $game->getBoard()[6][2]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([6, 2], [2, 6]);
        sort($squares);

        $expectedSquares = [[3, 5], [4, 4], [5, 3]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
        
        /* Position 2 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[4][3]->setPiece(new King('SOPEDF', [4, 3], 'black'));
        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'white'));
        
        $game->getBoard()[1][6]->setPiece(new Bishop('SOPEDF', [1, 6], 'white'));
        
        $squares = $game->getBoard()[4][3]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([4, 3], [1, 6]);
        sort($squares);

        $expectedSquares = [[3, 4], [2, 5]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);

        /* Position 3 */
        $game = new Game();

        $board = $game->getBoard();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[6][6]->setPiece(new King('SOPEDF', [6, 6], 'black'));
        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'white'));
        
        $game->getBoard()[4][8]->setPiece(new Quenn('SOPEDF', [4, 8], 'white'));
        
        $squares = $game->getBoard()[6][6]->getPiece()->getSquaresOnWhichMyPieceWouldBlockCheck([6, 6], [4, 8]);
        sort($squares);

        $expectedSquares = [[5, 7]];
        sort($expectedSquares);

        $this->assertEquals($squares, $expectedSquares);
    }
}