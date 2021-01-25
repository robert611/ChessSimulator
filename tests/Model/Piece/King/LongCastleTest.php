<?php 

namespace App\Tests\Model\King;

use App\Model\Piece\Rook;
use App\Model\Piece\Quenn;
use App\Model\Piece\Bishop;
use App\Model\Piece\King;
use App\Model\Piece\Knight;
use App\Model\Piece\Pawn;
use App\Model\Board;
use App\Model\Game;

use PHPUnit\Framework\TestCase;

class LongCastleTest extends TestCase
{
    public function testIfKingCanCastle()
    {
        /* Position 1 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[1][5]->setPiece(new King('ESFTWE', [1, 5], 'white'));
        $game->getBoard()[8][5]->setPiece(new King('DSE332', [8, 5], 'black'));

        $game->getBoard()[1][1]->setPiece(new Rook('DF34UU', [1, 1], 'white'));

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[1][5]->setPiece(new King('ESFTWE', [1, 5], 'white'));
        $game->getBoard()[8][5]->setPiece(new King('DSE332', [8, 5], 'black'));

        $game->getBoard()[1][1]->setPiece(new Rook('DF34UU', [1, 1], 'white'));
        $game->getBoard()[6][6]->setPiece(new Quenn('DSD23D', [6, 6], 'black'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DF34UU', [8, 1], 'black'));
        $game->getBoard()[2][1]->setPiece(new Rook('24GSFP', [2, 1], 'white'));

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 4 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DF34UU', [8, 1], 'black'));

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        foreach ($games as $game) 
        {
            $isThereCastleMove = false;
            $moves = $game['king']->getPossibleMoves($game['game']);

            /* Only durgin castle player makes two moves in a row */
            foreach ($moves as $move)
            {
                if (isset($move[0]['from'])) {
                    $isThereCastleMove = true;
                    $kingFrom = $move[0]['from'];
                    $kingTo = $move[0]['to'];

                    $rookFrom = $move[1]['from'];
                    $rookTo = $move[1]['to'];
                }
            }

            if ($game['king']->getSide() == 'white') 
            {
                $expectedKingFrom = [1, 5];
                $expectedKingTo = [1, 3];
                $expectedRookFrom = [1, 1];
                $expectedRookTo = [1, 4];

            }
            else 
            {
                $expectedKingFrom = [8, 5];
                $expectedKingTo = [8, 3];
                $expectedRookFrom = [8, 1];
                $expectedRookTo = [8, 4];
            }

            $this->assertTrue($isThereCastleMove);
            $this->assertEquals($kingFrom, $expectedKingFrom);
            $this->assertEquals($kingTo, $expectedKingTo);
            $this->assertEquals($rookFrom, $expectedRookFrom);
            $this->assertEquals($rookTo, $expectedRookTo);
        }
    }

    public function testIfKingCannnotCastleCauseThereIsAPieceBeetwenKingAndRook()
    {
        /* Position 1 white King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('4GJFVC', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('DFDF23', [1, 1], 'white'));
        $game->getBoard()[1][2]->setPiece(new Knight('SDF342', [1, 2], 'white'));

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 white King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('4GJFVC', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('DFDF23', [1, 1], 'white'));
        $game->getBoard()[1][4]->setPiece(new Quenn('SDF342', [1, 4], 'white'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 white King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('4GJFVC', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('DFDF23', [1, 1], 'white'));
        $game->getBoard()[1][4]->setPiece(new Quenn('SDF342', [1, 4], 'white'));
        $game->getBoard()[1][3]->setPiece(new Bishop('JUYY34', [1, 3], 'white'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 4 black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('4GJFVC', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DFDF23', [8, 1], 'black'));
        $game->getBoard()[8][4]->setPiece(new Quenn('SDF342', [8, 4], 'black'));
        $game->getBoard()[8][3]->setPiece(new Bishop('JUYY34', [8, 3], 'black'));

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 5 black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('4GJFVC', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DFDF23', [8, 1], 'black'));
        $game->getBoard()[8][2]->setPiece(new Knight('SDF342', [8, 2], 'black'));

        $games[4]['game'] = $game;
        $games[4]['king'] = $game->getBoard()[8][5]->getPiece();

        foreach ($games as $game) 
        {
            $isThereCastleMove = false;
            $moves = $game['king']->getPossibleMoves($game['game']);

            /* Only during castle player makes two moves in a row */
            foreach ($moves as $move)
            {
                if (isset($move[0]['from'])) $isThereCastleMove = true;
            }

            $this->assertFalse($isThereCastleMove);
        } 
    }

    public function testIfKingCannnotCastleCauseSquareBeetwenKingAndRookIsAttacked()
    {
        /* Position 1 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('2FSDFD', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3FDS3S', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('Q26VSD', [1, 1], 'white'));
        $game->getBoard()[2][5]->setPiece(new Knight('233FRD', [2, 5], 'black'));

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('2FSDFD', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3FDS3S', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('Q26VSD', [1, 1], 'white'));
        $game->getBoard()[2][3]->setPiece(new Quenn('233FRD', [2, 3], 'black'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('2FSDFD', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3FDS3S', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('Q26VSD', [8, 1], 'black'));
        $game->getBoard()[6][4]->setPiece(new Bishop('233FRD', [6, 4], 'white'));

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 4 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('2FSDFD', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3FDS3S', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('Q26VSD', [8, 1], 'black'));
        $game->getBoard()[7][3]->setPiece(new Pawn('233FRD', [7, 3], 'white'));

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        foreach ($games as $game) 
        {
            $isThereCastleMove = false;
            $moves = $game['king']->getPossibleMoves($game['game']);

            /* Only during castle player makes two moves in a row */
            foreach ($moves as $move)
            {
                if (isset($move[0]['from'])) $isThereCastleMove = true;
            }

            $this->assertFalse($isThereCastleMove);
        }
    }

    public function testIfKingCannnotCastleCauseRookMoved()
    {
        /* Position 1 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('AW235G', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('QE32VW', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('AQ23FS', [1, 1], 'white'));
        $game->makeMove($game->getBoard()[1][1]->getPiece(), [2, 1]);
        $game->makeMove($game->getBoard()[2][1]->getPiece(), [1, 1]);

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('AW235G', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('QE32VW', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('AQ23FS', [1, 1], 'white'));
        $game->makeMove($game->getBoard()[1][1]->getPiece(), [1, 4]);
        $game->makeMove($game->getBoard()[1][4]->getPiece(), [1, 2]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [1, 1]);

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('AW235G', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('QE32VW', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('AQ23FS', [8, 1], 'black'));
        $game->makeMove($game->getBoard()[8][1]->getPiece(), [4, 1]);
        $game->makeMove($game->getBoard()[4][1]->getPiece(), [8, 1]);

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 4 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('AW235G', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('QE32VW', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('AQ23FS', [8, 1], 'black'));
        $game->makeMove($game->getBoard()[8][1]->getPiece(), [8, 4]);
        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 2]);
        $game->makeMove($game->getBoard()[8][2]->getPiece(), [8, 1]);

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

        foreach ($games as $game) 
        {
            $isThereCastleMove = false;
            $moves = $game['king']->getPossibleMoves($game['game']);

            /* Only durgin castle player makes two moves in a row */
            foreach ($moves as $move)
            {
                if (isset($move[0][0])) $isThereCastleMove = true;
            }

            $this->assertFalse($isThereCastleMove);
        }
    }

    public function testIfKingCannnotCastleCauseKingMoved()
    {
        /* Position 1 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('ESFTWE', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('DF3423', [1, 1], 'white'));
        $game->makeMove($game->getBoard()[1][5]->getPiece(), [1, 6]);
        $game->makeMove($game->getBoard()[1][6]->getPiece(), [1, 5]);

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('ESFTWE', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('DF3423', [1, 1], 'white'));
        $game->makeMove($game->getBoard()[1][5]->getPiece(), [1, 4]);
        $game->makeMove($game->getBoard()[1][4]->getPiece(), [2, 5]);
        $game->makeMove($game->getBoard()[2][5]->getPiece(), [1, 5]);

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DF3423', [8, 1], 'black'));
        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]);
        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 5]);

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 4 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DF3423', [8, 1], 'black'));
        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 6]);
        $game->makeMove($game->getBoard()[8][6]->getPiece(), [7, 6]);
        $game->makeMove($game->getBoard()[7][6]->getPiece(), [8, 5]);

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        foreach ($games as $game) 
        {
            $isThereCastleMove = false;
            $moves = $game['king']->getPossibleMoves($game['game']);

            /* Only durgin castle player makes two moves in a row */
            foreach ($moves as $move)
            {
                if (isset($move[0]['from'])) $isThereCastleMove = true;
            }

            $this->assertFalse($isThereCastleMove);
        }
    }

    public function testIfKingCannnotCastleCauseKingIsInCheck()
    {
        /* Position 1 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('ESFTWE', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('DF3423', [1, 1], 'white'));
        $game->getBoard()[4][5]->setPiece(new Rook('USTERS', [4, 5], 'black'));

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }
 
        $game->getBoard()[8][1]->setPiece(new King('ESFTWE', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[1][1]->setPiece(new Rook('DF3423', [1, 1], 'white'));
        $game->getBoard()[4][8]->setPiece(new Bishop('USTERS', [4, 8], 'black'));
        $game->getBoard()[3][4]->setPiece(new Knight('K76VKO', [3, 4], 'black'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }
           
        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DF3423', [8, 1], 'black'));
        $game->getBoard()[6][3]->setPiece(new Quenn('USTERS', [6, 3], 'white'));

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 4 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }
         
        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][1]->setPiece(new Rook('DF3423', [8, 1], 'black'));
        $game->getBoard()[7][3]->setPiece(new Knight('USTERS', [7, 3], 'white'));

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        foreach ($games as $game) 
        {
            $isThereCastleMove = false;
            $moves = $game['king']->getPossibleMoves($game['game']);

            /* Only during castle player makes two moves in a row */
            foreach ($moves as $move)
            {
                if (isset($move[0]['from'])) $isThereCastleMove = true;
            }

            $this->assertFalse($isThereCastleMove);
        } 
    }
}