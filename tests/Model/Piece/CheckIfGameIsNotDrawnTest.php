<?php 

namespace App\Tests\Model;

use App\Model\Board;
use App\Model\Game;
use App\Model\Piece\Rook;
use App\Model\Piece\Quenn;
use App\Model\Piece\Bishop;
use App\Model\Piece\King;
use App\Model\Piece\Knight;
use App\Model\Piece\Pawn;

use PHPUnit\Framework\TestCase;

class CheckIfGameIsNotDrawnTest extends TestCase
{
    public function testIfKingAndKnightAgainstKingAndKnightIsNotADraw()
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

        $game->getBoard()[5][5]->setPiece(new Knight('SOPEDF', [5, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new Knight('SOPEDF', [1, 5], 'white'));

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[7][2]->setPiece(new Knight('SOPEDF', [7, 2], 'black'));
        $game->getBoard()[2][8]->setPiece(new Knight('SOPEDF', [2, 8], 'white'));

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[5][3]->setPiece(new Knight('SOPEDF', [5, 3], 'white'));
        $game->getBoard()[5][7]->setPiece(new Knight('SOPEDF', [5, 7], 'black'));

        $games[2] = $game;

        foreach ($games as $game)
        {
            $this->assertFalse($game->checkIfGameIsDrawn());
        }
    }

    public function testIfKingAndBishopAgainstKingAndBishopOfDiffrentColorIsNotADraw()
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

        $game->getBoard()[5][3]->setPiece(new Bishop('SOPEDF', [5, 3], 'black'));
        $game->getBoard()[5][6]->setPiece(new Bishop('SOPEDF', [5, 6], 'white'));

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[8][1]->setPiece(new Bishop('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[4][2]->setPiece(new Bishop('SOPEDF', [4, 2], 'white'));

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        $game->getBoard()[8][3]->setPiece(new Bishop('SOPEDF', [8, 3], 'black'));
        $game->getBoard()[2][8]->setPiece(new Bishop('SOPEDF', [2, 8], 'white'));

        $games[2] = $game;

        foreach ($games as $game)
        {
            $this->assertFalse($game->checkIfGameIsDrawn());
        }
    }

    public function testIfKingAndBishopAgainstKingAndManyBishopsOfTheSameColorIsNotADraw()
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

        $game->getBoard()[8][3]->setPiece(new Bishop('SOPEDF', [8, 3], 'black'));
        $game->getBoard()[2][8]->setPiece(new Bishop('SOPEDF', [2, 8], 'white'));
        $game->getBoard()[2][6]->setPiece(new Bishop('SOPEDF', [2, 6], 'white'));

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[7][7]->setPiece(new King('SOPEDF', [7, 7], 'black'));
        $game->getBoard()[5][4]->setPiece(new King('SOPEDF', [5, 4], 'white'));

        $game->getBoard()[8][2]->setPiece(new Bishop('SOPEDF', [8, 2], 'black'));
        $game->getBoard()[4][3]->setPiece(new Bishop('SOPEDF', [4, 3], 'white'));
        $game->getBoard()[1][2]->setPiece(new Bishop('SOPEDF', [1, 2], 'white'));
        $game->getBoard()[2][5]->setPiece(new Bishop('SOPEDF', [2, 5], 'white'));

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[7][7]->setPiece(new King('SOPEDF', [7, 7], 'black'));
        $game->getBoard()[5][4]->setPiece(new King('SOPEDF', [5, 4], 'white'));

        $game->getBoard()[7][3]->setPiece(new Bishop('SOPEDF', [7, 3], 'black'));
        $game->getBoard()[7][5]->setPiece(new Bishop('SOPEDF', [7, 5], 'black'));
        $game->getBoard()[3][2]->setPiece(new Bishop('SOPEDF', [3, 2], 'white'));
        $game->getBoard()[2][7]->setPiece(new Bishop('SOPEDF', [2, 7], 'white'));
        $game->getBoard()[1][4]->setPiece(new Bishop('SOPEDF', [1, 4], 'white'));

        $games[2] = $game;

        foreach ($games as $game)
        {
            $this->assertFalse($game->checkIfGameIsDrawn());
        }
    }

    public function testIfTwoHoldRepetitionIsNotADraw()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));
        $game->getBoard()[6][6]->setPiece(new King('SOPEDF', [6, 6], 'black'));

        $game->getBoard()[4][1]->setPiece(new Pawn('SOPEDF', [4, 1], 'white'));
        $game->getBoard()[5][3]->setPiece(new Pawn('SOPEDF', [5, 3], 'white'));
        $game->getBoard()[4][5]->setPiece(new Pawn('SOPEDF', [4, 5], 'white'));
        $game->getBoard()[4][7]->setPiece(new Pawn('SOPEDF', [4, 7], 'white'));

        $game->getBoard()[5][1]->setPiece(new Pawn('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[6][3]->setPiece(new Pawn('SOPEDF', [6, 3], 'black'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'black'));
        $game->getBoard()[5][7]->setPiece(new Pawn('SOPEDF', [5, 7], 'black'));

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [3, 2]); /* White king [3, 2] Black King [6, 6] */

        $game->makeMove($game->getBoard()[6][6]->getPiece(), [7, 5]); /* White king [3, 2] Black King [7, 5] */

        $game->makeMove($game->getBoard()[3][2]->getPiece(), [3, 1]); /* White king [3, 1] Black King [7, 5] */

        $game->makeMove($game->getBoard()[7][5]->getPiece(), [8, 5]); /* White king [3, 1] Black King [8, 5] */

        $game->makeMove($game->getBoard()[3][1]->getPiece(), [2, 1]); /* White king [2, 1] Black King [8, 5] */

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [7, 6]); /* White king [2, 1] Black King [7, 6] */

        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 2]); /* White king [3, 2] Black King [7, 6] */

        $game->makeMove($game->getBoard()[7][6]->getPiece(), [6, 6]); /* White king [3, 2] Black King [6, 6] -- Second Occurance */

        $game->makeMove($game->getBoard()[3][2]->getPiece(), [2, 2]); /* White king [2, 2] Black King [6, 6] */

        $game->makeMove($game->getBoard()[6][6]->getPiece(), [6, 5]); /* White king [2, 2] Black King [6, 5] */

        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 2]); /* White king [3, 2] Black King [6, 5] */
        
        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[3][5]->setPiece(new King('SOPEDF', [3, 5], 'white'));
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));

        $game->getBoard()[8][1]->setPiece(new Knight('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[8][2]->setPiece(new Bishop('SOPEDF', [8, 2], 'black'));

        $game->getBoard()[4][7]->setPiece(new Bishop('SOPEDF', [4, 7], 'white'));

        $game->getBoard()[7][3]->setPiece(new Pawn('SOPEDF', [7, 3], 'black'));
        $game->getBoard()[7][5]->setPiece(new Pawn('SOPEDF', [7, 5], 'black'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'black'));
        $game->getBoard()[6][2]->setPiece(new Pawn('SOPEDF', [6, 2], 'black'));

        $game->getBoard()[6][3]->setPiece(new Pawn('SOPEDF', [6, 3], 'white'));
        $game->getBoard()[6][5]->setPiece(new Pawn('SOPEDF', [6, 5], 'white'));
        $game->getBoard()[6][7]->setPiece(new Pawn('SOPEDF', [6, 7], 'white'));
        $game->getBoard()[5][2]->setPiece(new Pawn('SOPEDF', [5, 2], 'white'));

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]); /* White king [3, 5] Black King [8, 4] First Occurance */
        $game->makeMove($game->getBoard()[3][5]->getPiece(), [3, 6]); /* White king [3, 6] Black King [8, 4] First Occurance */

        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 5]); /* White king [3, 6] Black King [8, 5] First Occurance */
        $game->makeMove($game->getBoard()[3][6]->getPiece(), [3, 5]); /* White king [3, 5] Black King [8, 5] First Occurance */

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]); /* White king [3, 5] Black King [8, 4] Second Occurance */
        $game->makeMove($game->getBoard()[3][5]->getPiece(), [3, 6]); /* White king [3, 6] Black King [8, 4] Second Occurance */

        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 5]); /* White king [3, 6] Black King [8, 5] Second Occurance */
        $game->makeMove($game->getBoard()[3][6]->getPiece(), [3, 5]); /* White king [3, 5] Black King [8, 5] Second Occurance */

        $games[1] = $game;

        foreach ($games as $game) {
            $this->assertFalse($game->checkIfGameIsDrawn());
        }
    }

    public function testIfFiftyMovesWithPawnMoveIsNotADraw()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));
        $game->getBoard()[6][6]->setPiece(new King('SOPEDF', [6, 6], 'black'));

        $game->getBoard()[4][1]->setPiece(new Pawn('SOPEDF', [4, 1], 'white'));
        $game->getBoard()[5][3]->setPiece(new Pawn('SOPEDF', [5, 3], 'white'));
        $game->getBoard()[4][5]->setPiece(new Pawn('SOPEDF', [4, 5], 'white'));
        $game->getBoard()[4][7]->setPiece(new Pawn('SOPEDF', [4, 7], 'white'));

        $game->getBoard()[5][1]->setPiece(new Pawn('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[6][3]->setPiece(new Pawn('SOPEDF', [6, 3], 'black'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'black'));
        $game->getBoard()[6][7]->setPiece(new Pawn('SOPEDF', [6, 7], 'black'));

        /* First of 50 moves made with a pawn */
        $game->makeMove($game->getBoard()[6][7]->getPiece(), [5, 7]);

        $game->playGame(49);

        $games[0] = $game;

        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));
        $game->getBoard()[6][6]->setPiece(new King('SOPEDF', [6, 6], 'black'));

        $game->getBoard()[4][1]->setPiece(new Pawn('SOPEDF', [4, 1], 'white'));
        $game->getBoard()[5][3]->setPiece(new Pawn('SOPEDF', [5, 3], 'white'));
        $game->getBoard()[4][5]->setPiece(new Pawn('SOPEDF', [4, 5], 'white'));
        $game->getBoard()[4][7]->setPiece(new Pawn('SOPEDF', [4, 7], 'white'));

        $game->getBoard()[5][1]->setPiece(new Pawn('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[7][3]->setPiece(new Pawn('SOPEDF', [7, 3], 'black'));
        $game->getBoard()[5][5]->setPiece(new Pawn('SOPEDF', [5, 5], 'black'));
        $game->getBoard()[5][7]->setPiece(new Pawn('SOPEDF', [5, 7], 'black'));

        /* First of 50 moves made with a pawn */
        $game->makeMove($game->getBoard()[7][3]->getPiece(), [6, 3]);

        $game->playGame(49);

        $games[1] = $game;

        for ($u = 1; $u <= 5; $u++)
        {
            $game = new Game();

            for ($i = 1; $i <= 8; $i++) {
                for ($j = 1; $j <= 8; $j++) {
                    $game->getBoard()[$i][$j]->setPiece(null);
                }
            }
    
            $game->getBoard()[3][5]->setPiece(new King('SOPEDF', [3, 5], 'white'));
            $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
    
            $game->getBoard()[8][1]->setPiece(new Knight('SOPEDF', [8, 1], 'black'));
            $game->getBoard()[8][2]->setPiece(new Bishop('SOPEDF', [8, 2], 'black'));
    
            $game->getBoard()[4][7]->setPiece(new Bishop('SOPEDF', [4, 7], 'white'));
    
            $game->getBoard()[7][3]->setPiece(new Pawn('SOPEDF', [7, 3], 'black'));
            $game->getBoard()[7][5]->setPiece(new Pawn('SOPEDF', [7, 5], 'black'));
            $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'black'));
            $game->getBoard()[6][2]->setPiece(new Pawn('SOPEDF', [6, 2], 'black'));
    
            $game->getBoard()[6][3]->setPiece(new Pawn('SOPEDF', [6, 3], 'white'));
            $game->getBoard()[6][5]->setPiece(new Pawn('SOPEDF', [6, 5], 'white'));
            $game->getBoard()[6][7]->setPiece(new Pawn('SOPEDF', [6, 7], 'white'));
            $game->getBoard()[4][2]->setPiece(new Pawn('SOPEDF', [4, 2], 'white'));
    
            $game->makeMove($game->getBoard()[4][2]->getPiece(), [5, 2]);
    
            $game->playGame(49);
    
            $games[1 + $u] = $game;
        } 

        foreach ($games as $game) {
            if ($game->getResult()['type'] !== 'three_hold_repetition') $this->assertFalse($game->checkIfGameIsDrawn());
        }
    }

    public function testIfFiftyMovesWithCaptureIsNotADraw()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[3][5]->setPiece(new King('SOPEDF', [3, 5], 'white'));
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));

        $game->getBoard()[8][1]->setPiece(new Knight('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[7][2]->setPiece(new Bishop('SOPEDF', [7, 2], 'white'));
        $game->getBoard()[4][8]->setPiece(new Bishop('SOPEDF', [4, 8], 'white'));

        /* First move with capture */
        $game->makeMove($game->getBoard()[7][2]->getPiece(), [8, 1]);

        /* 49 nine moves with kings */
        $game->makeMove($game->getBoard()[3][5]->getPiece(), [3, 6]);
        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]); /* 3 moves */

        $game->makeMove($game->getBoard()[3][6]->getPiece(), [3, 7]);
        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 3]); /* 5 moves */

        $game->makeMove($game->getBoard()[3][7]->getPiece(), [3, 8]);
        $game->makeMove($game->getBoard()[8][3]->getPiece(), [8, 2]); /* 7 moves */

        $game->makeMove($game->getBoard()[3][8]->getPiece(), [2, 8]);
        $game->makeMove($game->getBoard()[8][2]->getPiece(), [7, 1]); /* 9 moves */

        $game->makeMove($game->getBoard()[2][8]->getPiece(), [2, 7]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 2]); /* 11 moves */

        $game->makeMove($game->getBoard()[2][7]->getPiece(), [2, 6]);
        $game->makeMove($game->getBoard()[6][2]->getPiece(), [7, 3]); /* 13 moves */

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [2, 5]);
        $game->makeMove($game->getBoard()[7][3]->getPiece(), [7, 4]); /* 15 moves */

        $game->makeMove($game->getBoard()[2][5]->getPiece(), [2, 4]);
        $game->makeMove($game->getBoard()[7][4]->getPiece(), [7, 5]); /* 17 moves */

        $game->makeMove($game->getBoard()[2][4]->getPiece(), [2, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [7, 6]); /* 19 moves */

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [2, 2]);
        $game->makeMove($game->getBoard()[7][6]->getPiece(), [7, 7]); /* 21 moves */

        $game->makeMove($game->getBoard()[2][2]->getPiece(), [2, 1]);
        $game->makeMove($game->getBoard()[7][7]->getPiece(), [7, 8]); /* 23 moves */

        $game->makeMove($game->getBoard()[2][1]->getPiece(), [1, 1]);
        $game->makeMove($game->getBoard()[7][8]->getPiece(), [6, 8]); /* 25 moves */

        $game->makeMove($game->getBoard()[1][1]->getPiece(), [1, 2]);
        $game->makeMove($game->getBoard()[6][8]->getPiece(), [6, 7]); /* 27 moves */

        $game->makeMove($game->getBoard()[1][2]->getPiece(), [1, 3]);
        $game->makeMove($game->getBoard()[6][7]->getPiece(), [6, 6]); /* 29 moves */

        $game->makeMove($game->getBoard()[1][3]->getPiece(), [1, 4]);
        $game->makeMove($game->getBoard()[6][6]->getPiece(), [6, 5]); /* 31 moves */

        $game->makeMove($game->getBoard()[1][4]->getPiece(), [1, 5]);
        $game->makeMove($game->getBoard()[6][5]->getPiece(), [6, 4]); /* 33 moves */

        $game->makeMove($game->getBoard()[1][5]->getPiece(), [1, 6]);
        $game->makeMove($game->getBoard()[6][4]->getPiece(), [6, 3]); /* 35 moves */

        $game->makeMove($game->getBoard()[1][6]->getPiece(), [1, 7]);
        $game->makeMove($game->getBoard()[6][3]->getPiece(), [6, 2]); /* 37 moves */

        $game->makeMove($game->getBoard()[1][7]->getPiece(), [1, 8]);
        $game->makeMove($game->getBoard()[6][2]->getPiece(), [6, 1]); /* 39 moves */

        $game->makeMove($game->getBoard()[1][8]->getPiece(), [2, 7]);
        $game->makeMove($game->getBoard()[6][1]->getPiece(), [5, 1]); /* 41 moves */

        $game->makeMove($game->getBoard()[2][7]->getPiece(), [2, 6]);
        $game->makeMove($game->getBoard()[5][1]->getPiece(), [5, 2]); /* 43 moves */

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [2, 5]);
        $game->makeMove($game->getBoard()[5][2]->getPiece(), [5, 3]); /* 45 moves */

        $game->makeMove($game->getBoard()[2][5]->getPiece(), [2, 4]);
        $game->makeMove($game->getBoard()[5][3]->getPiece(), [5, 4]); /* 47 moves */

        $game->makeMove($game->getBoard()[2][4]->getPiece(), [2, 3]);
        $game->makeMove($game->getBoard()[5][4]->getPiece(), [5, 5]); /* 49 moves */

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [2, 2]); /* 50 move */

        $games[0] = $game;

        foreach ($games as $game) {
            $this->assertFalse($game->checkIfGameIsDrawn());
        }
    }

    public function testIfPositionWithOnePossibleMoveIsNoTaStalemate()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[1][7]->setPiece(new King('SOPEDF', [1, 7], 'white'));

        $game->getBoard()[2][1]->setPiece(new Rook('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[6][8]->setPiece(new Rook('SOPEDF', [6, 8], 'white'));

        $game->makeMove($game->getBoard()[1][7]->getPiece(), [1, 8]);

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[1][7]->setPiece(new King('SOPEDF', [1, 7], 'white'));

        $game->getBoard()[6][3]->setPiece(new Quenn('SOPEDF', [6, 3], 'white'));
        $game->getBoard()[5][3]->setPiece(new Bishop('SOPEDF', [5, 3], 'white'));

        $game->makeMove($game->getBoard()[1][7]->getPiece(), [1, 8]);

        $games[1] = $game;

        foreach ($games as $game) {
            $this->assertFalse($game->checkIfGameIsDrawn());
        }
    }
}