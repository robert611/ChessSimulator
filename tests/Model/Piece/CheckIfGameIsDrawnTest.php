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

class CheckIfGameIsDrawnTest extends TestCase
{
    public function testIfTwoKingsOnTheBoardIsDrawnPosition()
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

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[4][4]->setPiece(new King('SOPEDF', [4, 4], 'black'));
        $game->getBoard()[6][4]->setPiece(new King('SOPEDF', [6, 4], 'white'));

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[4][1]->setPiece(new King('SOPEDF', [4, 1], 'black'));
        $game->getBoard()[8][4]->setPiece(new King('SOPEDF', [8, 4], 'white'));

        $games[2] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[7][8]->setPiece(new King('SOPEDF', [7, 8], 'white'));
        $game->getBoard()[5][8]->setPiece(new King('SOPEDF', [5, 8], 'black'));

        $games[3] = $game;

        foreach ($games as $game)
        {
            $this->assertTrue($game->checkIfGameIsDrawn());
        }
    }

    public function testIfKingAndKnightAgainstKingIsADraw()
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
        $game->getBoard()[2][4]->setPiece(new Knight('SOPEDF', [2, 4], 'white'));

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[3][3]->setPiece(new King('SOPEDF', [3, 3], 'white'));
        $game->getBoard()[5][5]->setPiece(new Knight('SOPEDF', [5, 5], 'white'));

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[4][4]->setPiece(new King('SOPEDF', [4, 4], 'white'));
        $game->getBoard()[6][2]->setPiece(new King('SOPEDF', [6, 2], 'black'));
        $game->getBoard()[8][8]->setPiece(new Knight('SOPEDF', [8, 8], 'black'));

        $games[2] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[5][3]->setPiece(new King('SOPEDF', [5, 3], 'white'));
        $game->getBoard()[1][5]->setPiece(new King('SOPEDF', [1, 5], 'black'));
        $game->getBoard()[7][7]->setPiece(new Knight('SOPEDF', [8, 8], 'black'));

        $games[3] = $game;

        foreach ($games as $game)
        {
            $this->assertTrue($game->checkIfGameIsDrawn());
        }
    }

    public function testIfKingAndBishopOrBishopsOfTheSameColorAgainstKingIsADraw()
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
        $game->getBoard()[2][4]->setPiece(new Bishop('SOPEDF', [2, 4], 'white'));

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
        $game->getBoard()[2][8]->setPiece(new Bishop('SOPEDF', [2, 8], 'white'));

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[6][6]->setPiece(new King('SOPEDF', [6, 6], 'white'));
        $game->getBoard()[4][6]->setPiece(new King('SOPEDF', [4, 6], 'black'));
        $game->getBoard()[4][3]->setPiece(new Bishop('SOPEDF', [4, 3], 'black'));

        $games[2] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[6][6]->setPiece(new King('SOPEDF', [6, 6], 'white'));
        $game->getBoard()[4][6]->setPiece(new King('SOPEDF', [4, 4], 'black'));
        $game->getBoard()[4][3]->setPiece(new Bishop('SOPEDF', [4, 3], 'black'));
        $game->getBoard()[4][5]->setPiece(new Bishop('SOPEDF', [4, 5], 'black'));

        $games[3] = $game;

        /* Position 5 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[6][3]->setPiece(new King('SOPEDF', [6, 3], 'black'));
        $game->getBoard()[4][3]->setPiece(new Bishop('SOPEDF', [4, 3], 'black'));
        $game->getBoard()[4][5]->setPiece(new Bishop('SOPEDF', [4, 5], 'black'));
        $game->getBoard()[3][6]->setPiece(new Bishop('SOPEDF', [3, 6], 'black'));
        $game->getBoard()[1][2]->setPiece(new Bishop('SOPEDF', [1, 2], 'black'));

        $games[4] = $game;

        /* Position 6 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[2][5]->setPiece(new King('SOPEDF', [2, 5], 'black'));
        $game->getBoard()[5][8]->setPiece(new King('SOPEDF', [5, 8], 'white'));
        $game->getBoard()[8][2]->setPiece(new Bishop('SOPEDF', [8, 2], 'white'));
        $game->getBoard()[7][1]->setPiece(new Bishop('SOPEDF', [7, 1], 'white'));
        $game->getBoard()[1][5]->setPiece(new Bishop('SOPEDF', [1, 5], 'white'));
        $game->getBoard()[6][4]->setPiece(new Bishop('SOPEDF', [6, 4], 'white'));

        $games[5] = $game;

        foreach ($games as $game)
        {
            $this->assertTrue($game->checkIfGameIsDrawn());
        }
    }

    public function testIfKingAndBishopOrBishopsOfTheSameColorAgainstKingAndBishopsOfTheSameColorAsOpponentsBishopsIsADraw()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[7][3]->setPiece(new Bishop('SOPEDF', [7, 3], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));
        $game->getBoard()[2][4]->setPiece(new Bishop('SOPEDF', [2, 4], 'white'));

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][3]->setPiece(new King('SOPEDF', [8, 3], 'black'));
        $game->getBoard()[5][2]->setPiece(new Bishop('SOPEDF', [5, 2], 'black'));
        $game->getBoard()[8][7]->setPiece(new Bishop('SOPEDF', [8, 7], 'black'));
        $game->getBoard()[2][7]->setPiece(new King('SOPEDF', [2, 7], 'white'));
        $game->getBoard()[2][3]->setPiece(new Bishop('SOPEDF', [2, 3], 'white'));

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][3]->setPiece(new King('SOPEDF', [8, 3], 'black'));
        $game->getBoard()[5][5]->setPiece(new Bishop('SOPEDF', [5, 5], 'black'));
        $game->getBoard()[4][4]->setPiece(new Bishop('SOPEDF', [4, 4], 'black'));
        $game->getBoard()[8][8]->setPiece(new Bishop('SOPEDF', [8, 8], 'black'));
        $game->getBoard()[2][7]->setPiece(new King('SOPEDF', [2, 7], 'white'));
        $game->getBoard()[2][2]->setPiece(new Bishop('SOPEDF', [2, 2], 'white'));
        $game->getBoard()[2][4]->setPiece(new Bishop('SOPEDF', [2, 4], 'white'));

        $games[2] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[5][5]->setPiece(new King('SOPEDF', [5, 5], 'black'));
        $game->getBoard()[5][4]->setPiece(new Bishop('SOPEDF', [5, 4], 'black'));
        $game->getBoard()[7][4]->setPiece(new Bishop('SOPEDF', [7, 4], 'black'));
        $game->getBoard()[3][4]->setPiece(new Bishop('SOPEDF', [3, 4], 'black'));
        $game->getBoard()[2][4]->setPiece(new King('SOPEDF', [2, 4], 'white'));
        $game->getBoard()[2][1]->setPiece(new Bishop('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[1][2]->setPiece(new Bishop('SOPEDF', [1, 2], 'white'));
        $game->getBoard()[6][7]->setPiece(new Bishop('SOPEDF', [6, 7], 'white'));
        $game->getBoard()[8][1]->setPiece(new Bishop('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[8][7]->setPiece(new Bishop('SOPEDF', [8, 7], 'white'));

        $games[3] = $game;

        foreach ($games as $game) {
            $this->assertTrue($game->checkIfGameIsDrawn());
        }
    }

    public function testIfStalemateIsADraw()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[1][1]->setPiece(new King('SOPEDF', [1, 1], 'white'));
        $game->getBoard()[7][7]->setPiece(new King('SOPEDF', [7, 7], 'black'));

        $game->getBoard()[8][2]->setPiece(new Rook('SOPEDF', [8, 2], 'black'));
        $game->getBoard()[7][4]->setPiece(new Rook('SOPEDF', [7, 4], 'black'));

        $game->getBoard()[5][8]->setPiece(new Knight('SOPEDF', [5, 8], 'black'));

        $game->getBoard()[4][1]->setPiece(new Quenn('SOPEDF', [4, 1], 'black'));

        $game->getBoard()[2][1]->setPiece(new Pawn('SOPEDF', [2, 1], 'white'));

        $game->makeMove($game->getBoard()[4][1]->getPiece(), [3, 1]); /* Stalemate is checked only if at least one moved was played in a game */

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[5][6]->setPiece(new King('SOPEDF', [5, 6], 'white'));

        $game->getBoard()[7][6]->setPiece(new Pawn('SOPEDF', [7, 6], 'white'));

        $game->makeMove($game->getBoard()[5][6]->getPiece(), [6, 6]); /* Stalemate is checked only if at least one moved was played in a game */

        $games[1] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[6][2]->setPiece(new King('SOPEDF', [6, 2], 'white'));

        $game->getBoard()[2][8]->setPiece(new Rook('SOPEDF', [2, 8], 'white'));
        $game->getBoard()[8][2]->setPiece(new Bishop('SOPEDF', [8, 2], 'black'));

        $game->makeMove($game->getBoard()[2][8]->getPiece(), [8, 8]); /* Stalemate is checked only if at least one moved was played in a game */

        $games[2] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[1][1]->setPiece(new King('SOPEDF', [1, 1], 'black'));
        $game->getBoard()[3][3]->setPiece(new King('SOPEDF', [3, 3], 'white'));

        $game->getBoard()[2][6]->setPiece(new Rook('SOPEDF', [2, 6], 'white'));

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [2, 2]); /* Stalemate is checked only if at least one moved was played in a game */

        $games[3] = $game;

        /* Position 5 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[1][1]->setPiece(new King('SOPEDF', [1, 1], 'black'));
        $game->getBoard()[5][7]->setPiece(new King('SOPEDF', [5, 7], 'white'));

        $game->getBoard()[2][1]->setPiece(new Pawn('SOPEDF', [2, 1], 'black'));
        $game->getBoard()[8][7]->setPiece(new Quenn('SOPEDF', [8, 7], 'white'));

        $game->makeMove($game->getBoard()[8][7]->getPiece(), [3, 2]); /* Stalemate is checked only if at least one moved was played in a game */

        $games[4] = $game;

        /* Position 6 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('SOPEDF', [8, 1], 'black'));
        $game->getBoard()[5][1]->setPiece(new King('SOPEDF', [5, 1], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'white'));
        $game->getBoard()[4][6]->setPiece(new Bishop('SOPEDF', [4, 6], 'white'));

        $game->makeMove($game->getBoard()[5][1]->getPiece(), [6, 1]); /* Stalemate is checked only if at least one moved was played in a game */

        $games[5] = $game;

        foreach ($games as $game) {
            $this->assertTrue($game->checkIfGameIsDrawn());
        }
    }

    public function testIfFiftyMovesWithoutCaptureOrPawnMoveIsADraw()
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

        $game->playGame();

        $games[0] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][4]->setPiece(new King('SOPEDF', [8, 4], 'black'));
        $game->getBoard()[7][2]->setPiece(new King('SOPEDF', [7, 2], 'white'));

        $game->getBoard()[8][2]->setPiece(new Bishop('SOPEDF', [8, 2], 'black'));
        $game->getBoard()[7][1]->setPiece(new Bishop('SOPEDF', [7, 1], 'black'));
        $game->getBoard()[8][6]->setPiece(new Bishop('SOPEDF', [8, 6], 'black'));

        $game->getBoard()[8][1]->setPiece(new Bishop('SOPEDF', [8, 1], 'white'));

        $game->getBoard()[4][1]->setPiece(new Pawn('SOPEDF', [4, 1], 'black'));
        $game->getBoard()[6][2]->setPiece(new Pawn('SOPEDF', [6, 2], 'black'));
        $game->getBoard()[7][3]->setPiece(new Pawn('SOPEDF', [7, 3], 'black'));
        $game->getBoard()[7][5]->setPiece(new Pawn('SOPEDF', [7, 5], 'black'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'black'));

        $game->getBoard()[3][1]->setPiece(new Pawn('SOPEDF', [3, 1], 'white'));
        $game->getBoard()[5][2]->setPiece(new Pawn('SOPEDF', [5, 2], 'white'));
        $game->getBoard()[6][3]->setPiece(new Pawn('SOPEDF', [6, 3], 'white'));
        $game->getBoard()[6][5]->setPiece(new Pawn('SOPEDF', [6, 5], 'white'));
        $game->getBoard()[6][7]->setPiece(new Pawn('SOPEDF', [6, 7], 'white'));
        $game->getBoard()[4][7]->setPiece(new Pawn('SOPEDF', [4, 7], 'white'));

        $game->playGame();

        $games[1] = $game;

        /* Position 3 */
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

        $game->playGame();

        $games[2] = $game;
        
        foreach ($games as $game) {
            $this->assertTrue($game->checkIfGameIsDrawn());
        }
    }

    public function testIfThreeHoldRepetitionIsADraw()
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

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]);
        $game->makeMove($game->getBoard()[3][5]->getPiece(), [3, 6]);

        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 5]);
        $game->makeMove($game->getBoard()[3][6]->getPiece(), [3, 5]);

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]);
        $game->makeMove($game->getBoard()[3][5]->getPiece(), [3, 6]);

        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 5]);
        $game->makeMove($game->getBoard()[3][6]->getPiece(), [3, 5]);

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]);

        $games[0] = $game;

        /* Position 2 */
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

        $game->makeMove($game->getBoard()[6][5]->getPiece(), [6, 6]); /* White king [3, 2] Black King [6, 6] -- Third Occurance */
       
        $games[1] = $game;

        foreach ($games as $game) {
            $this->assertTrue($game->checkIfGameIsDrawn());
        }
    }
}