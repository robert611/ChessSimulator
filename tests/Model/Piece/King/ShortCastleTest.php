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

class ShortCastleTest extends TestCase
{
    public function testIfKingCanCastle()
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('4FGSD5', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3423BB', [1, 5], 'white'));

        $game->getBoard()[1][8]->setPiece(new Rook('4BDD36', [1, 8], 'white'));

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        /* Rooks */
        $game->getBoard()[1][1]->setPiece(new Rook('D23FSD', [1, 1], 'white'));
        $game->getBoard()[1][8]->setPiece(new Rook('324FAS', [1, 8], 'white'));
        $game->getBoard()[8][1]->setPiece(new Rook('34VDSV', [8, 8], 'black'));
        $game->getBoard()[8][8]->setPiece(new Rook('WEU9LG', [8, 8], 'black'));

        /* Knights */
        $game->getBoard()[1][2]->setPiece(new Knight('C234VW', [1, 2], 'white'));
        $game->getBoard()[3][6]->setPiece(new Knight('QWD5HW', [3, 6], 'white'));
        $game->getBoard()[6][3]->setPiece(new Knight('234VBB', [6, 3], 'black'));
        $game->getBoard()[6][6]->setPiece(new Knight('S34HDS', [6, 6], 'black'));

        /* Bishops */
        $game->getBoard()[4][3]->setPiece(new Bishop('FDSF32', [4, 3], 'white'));
        $game->getBoard()[5][7]->setPiece(new Bishop('SDFF3T', [5, 7], 'white'));
        $game->getBoard()[8][3]->setPiece(new Bishop('VBS34S', [8, 3], 'black'));
        $game->getBoard()[5][3]->setPiece(new Bishop('G3423H', [5, 3], 'black'));

        /* Pawns */
        $game->getBoard()[2][1]->setPiece(new Pawn('4FCVSD', [2, 1], 'white'));
        $game->getBoard()[2][2]->setPiece(new Pawn('2343FS', [2, 2], 'white'));
        $game->getBoard()[2][3]->setPiece(new Pawn('SFDDF4', [2, 3], 'white'));
        $game->getBoard()[3][4]->setPiece(new Pawn('SDF3FS', [3, 4], 'white'));
        $game->getBoard()[4][5]->setPiece(new Pawn('SDF3HS', [4, 5], 'white'));
        $game->getBoard()[2][6]->setPiece(new Pawn('H56WE3', [2, 6], 'white'));
        $game->getBoard()[2][7]->setPiece(new Pawn('VS6544', [2, 7], 'white'));
        $game->getBoard()[2][8]->setPiece(new Pawn('FD346H', [2, 8], 'white'));

        /* Pawns */
        $game->getBoard()[7][1]->setPiece(new Pawn('IUJMGH', [7, 1], 'black'));
        $game->getBoard()[7][2]->setPiece(new Pawn('POIOLH', [7, 2], 'black'));
        $game->getBoard()[7][3]->setPiece(new Pawn('VSDHJS', [7, 3], 'black'));
        $game->getBoard()[7][4]->setPiece(new Pawn('234H53', [7, 4], 'black'));
        $game->getBoard()[5][5]->setPiece(new Pawn('REWR6A', [5, 5], 'black'));
        $game->getBoard()[7][6]->setPiece(new Pawn('34VSDF', [7, 6], 'black'));
        $game->getBoard()[7][7]->setPiece(new Pawn('4324GD', [7, 7], 'black'));
        $game->getBoard()[7][8]->setPiece(new Pawn('ASDFAS', [7, 8], 'black'));

        /* Quenns */
        $game->getBoard()[1][4]->setPiece(new Quenn('CAD3R4', [1, 4], 'white'));
        $game->getBoard()[8][4]->setPiece(new Quenn('32423F', [8, 4], 'black'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        /* Pawns */
        $game->getBoard()[2][6]->setPiece(new Pawn('ADS3R4', [2, 6], 'white'));
        $game->getBoard()[2][7]->setPiece(new Pawn('DFS5BS', [2, 7], 'white'));
        $game->getBoard()[2][8]->setPiece(new Pawn('45IDFG', [2, 8], 'white'));

        /* Rooks */
        $game->getBoard()[1][1]->setPiece(new Rook('D23FSD', [1, 1], 'white'));
        $game->getBoard()[1][8]->setPiece(new Rook('324FAS', [1, 8], 'white'));
        $game->getBoard()[8][8]->setPiece(new Rook('WEU9LG', [8, 8], 'black'));

        /* Knights */
        $game->getBoard()[1][2]->setPiece(new Knight('C234VW', [1, 2], 'white'));
        $game->getBoard()[3][6]->setPiece(new Knight('QWD5HW', [3, 6], 'white'));

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[1][5]->getPiece();

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        /* Pawns */
        $game->getBoard()[2][6]->setPiece(new Pawn('7567JF', [2, 6], 'white'));
        $game->getBoard()[2][7]->setPiece(new Pawn('567FJF', [2, 7], 'white'));
        $game->getBoard()[2][8]->setPiece(new Pawn('78GJHJ', [2, 8], 'white'));

        $game->getBoard()[7][6]->setPiece(new Pawn('SFSD32', [7, 6], 'black'));
        $game->getBoard()[7][7]->setPiece(new Pawn('DFYHFN', [7, 7], 'black'));
        $game->getBoard()[7][8]->setPiece(new Pawn('IO6797', [7, 8], 'black'));

        /* Rooks */
        $game->getBoard()[1][1]->setPiece(new Rook('D23FSD', [1, 1], 'white'));
        $game->getBoard()[1][8]->setPiece(new Rook('324FAS', [1, 8], 'white'));
        $game->getBoard()[8][1]->setPiece(new Rook('34VDSV', [8, 8], 'black'));
        $game->getBoard()[8][8]->setPiece(new Rook('WEU9LG', [8, 8], 'black'));

        /* Knights */
        $game->getBoard()[1][2]->setPiece(new Knight('C234VW', [1, 2], 'white'));
        $game->getBoard()[3][6]->setPiece(new Knight('QWD5HW', [3, 6], 'white'));

        /* Quenns */
        $game->getBoard()[8][3]->setPiece(new Quenn('QWD5HW', [8, 3], 'black'));

        $games[4]['game'] = $game;
        $games[4]['king'] = $game->getBoard()[8][5]->getPiece();

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
                $expectedKingTo = [1, 7];
                $expectedRookFrom = [1, 8];
                $expectedRookTo = [1, 6];

            }
            else 
            {
                $expectedKingFrom = [8, 5];
                $expectedKingTo = [8, 7];
                $expectedRookFrom = [8, 8];
                $expectedRookTo = [8, 6];
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
        /* Position 1 Short castle by white King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('4GJFVC', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[1][8]->setPiece(new Rook('DFDF23', [1, 8], 'white'));
        $game->getBoard()[1][7]->setPiece(new Knight('SDF342', [1, 7], 'white'));

        $games[0]['game'] = $game;
        $games[0]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 2 Short castle by black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('4GJFVC', [8, 5], 'black'));
        $game->getBoard()[1][1]->setPiece(new King('DSF4HU', [1, 1], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('DFDF23', [8, 8], 'black'));
        $game->getBoard()[8][7]->setPiece(new Knight('SDF342', [8, 7], 'black'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 3 Short castle by white King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('4GJFVC', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[1][8]->setPiece(new Rook('DFDF23', [1, 8], 'white'));
        $game->getBoard()[1][6]->setPiece(new Bishop('SDF342', [1, 6], 'white'));

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 4 Short castle by black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('4GJFVC', [8, 5], 'black'));
        $game->getBoard()[1][1]->setPiece(new King('DSF4HU', [1, 1], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('DFDF23', [8, 8], 'black'));
        $game->getBoard()[8][6]->setPiece(new Bishop('SDF342', [8, 6], 'black'));

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 5 Short castle by white King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('4GJFVC', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSF4HU', [1, 5], 'white'));

        $game->getBoard()[1][8]->setPiece(new Rook('DFDF23', [1, 8], 'white'));
        $game->getBoard()[1][7]->setPiece(new Knight('ASDEWQ', [1, 7], 'white'));
        $game->getBoard()[1][6]->setPiece(new Bishop('123GAS', [1, 6], 'white'));

        $games[4]['game'] = $game;
        $games[4]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 6 Short castle by black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('4GJFVC', [8, 5], 'black'));
        $game->getBoard()[1][1]->setPiece(new King('DSF4HU', [1, 1], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('DFDF23', [8, 8], 'black'));
        $game->getBoard()[8][7]->setPiece(new Knight('ASDEWQ', [8, 7], 'black'));
        $game->getBoard()[8][6]->setPiece(new Bishop('SDF342', [8, 6], 'black'));

        $games[5]['game'] = $game;
        $games[5]['king'] = $game->getBoard()[8][5]->getPiece();

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

        $game->getBoard()[1][8]->setPiece(new Rook('Q26VSD', [1, 8], 'white'));
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

        $game->getBoard()[1][8]->setPiece(new Rook('Q26VSD', [1, 8], 'white'));
        $game->getBoard()[5][3]->setPiece(new Bishop('DASD4D', [5, 3], 'black'));
        $game->getBoard()[6][1]->setPiece(new Bishop('233FRD', [6, 1], 'black'));

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 White King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][1]->setPiece(new King('2FSDFD', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3FDS3S', [1, 5], 'white'));

        $game->getBoard()[1][8]->setPiece(new Rook('Q26VSD', [1, 8], 'white'));
        $game->getBoard()[8][7]->setPiece(new Quenn('DASD4D', [8, 7], 'black'));
        $game->getBoard()[2][4]->setPiece(new Knight('233FRD', [2, 4], 'black'));

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 4 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('2FSDFD', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3FDS3S', [1, 5], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('Q26VSD', [8, 8], 'black'));
        $game->getBoard()[1][7]->setPiece(new Rook('ASDA4G', [1, 7], 'white'));

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 5 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('2FSDFD', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('3FDS3S', [1, 5], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('Q26VSD', [8, 8], 'black'));
        $game->getBoard()[1][7]->setPiece(new Rook('ASDA4G', [1, 7], 'white'));
        $game->getBoard()[2][1]->setPiece(new Bishop('PDOSAM', [2, 1], 'white'));

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

        $game->getBoard()[1][8]->setPiece(new Rook('AQ23FS', [1, 8], 'white'));
        $game->makeMove($game->getBoard()[1][8]->getPiece(), [2, 8]);
        $game->makeMove($game->getBoard()[2][8]->getPiece(), [1, 8]);

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

        $game->getBoard()[1][8]->setPiece(new Rook('AQ23FS', [1, 8], 'white'));
        $game->getBoard()[8][4]->setPiece(new Knight('SWFGVS', [8, 4], 'black'));

        $game->makeMove($game->getBoard()[1][8]->getPiece(), [2, 8]);
        $game->makeMove($game->getBoard()[2][8]->getPiece(), [8, 8]);
        $game->makeMove($game->getBoard()[8][8]->getPiece(), [1, 8]);

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

        $game->getBoard()[8][8]->setPiece(new Rook('AQ23FS', [8, 8], 'black'));
        $game->getBoard()[1][2]->setPiece(new Bishop('SWFGVS', [1, 2], 'white'));

        $game->makeMove($game->getBoard()[8][8]->getPiece(), [8, 6]);
        $game->makeMove($game->getBoard()[8][6]->getPiece(), [8, 8]);

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

        $game->getBoard()[8][8]->setPiece(new Rook('AQ23FS', [8, 8], 'black'));
        $game->getBoard()[4][6]->setPiece(new Bishop('SWFGVS', [4, 6], 'white'));

        $game->makeMove($game->getBoard()[8][8]->getPiece(), [2, 8]);
        $game->makeMove($game->getBoard()[2][8]->getPiece(), [3, 8]);
        $game->makeMove($game->getBoard()[3][8]->getPiece(), [8, 8]);

        $games[3]['game'] = $game;
        $games[3]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 5 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('AW235G', [8, 5], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('QE32VW', [1, 5], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('AQ23FS', [8, 8], 'black'));
        $game->getBoard()[8][2]->setPiece(new Quenn('FFERRS', [8, 2], 'black'));
        $game->getBoard()[1][8]->setPiece(new Rook('FSD42S', [1, 8], 'white'));
        $game->getBoard()[4][6]->setPiece(new Bishop('SWFGVS', [4, 6], 'white'));
        
        $game->makeMove($game->getBoard()[8][8]->getPiece(), [6, 8]);
        $game->makeMove($game->getBoard()[6][8]->getPiece(), [8, 8]);

        $games[4]['game'] = $game;
        $games[4]['king'] = $game->getBoard()[8][5]->getPiece();

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

        $game->getBoard()[1][8]->setPiece(new Rook('DF3423', [1, 8], 'white'));
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

        $game->getBoard()[1][8]->setPiece(new Rook('DF3423', [1, 8], 'white'));

        $game->makeMove($game->getBoard()[1][5]->getPiece(), [1, 6]);
        $game->makeMove($game->getBoard()[1][6]->getPiece(), [2, 6]);
        $game->makeMove($game->getBoard()[2][6]->getPiece(), [1, 5]);

        $games[1]['game'] = $game;
        $games[1]['king'] = $game->getBoard()[1][5]->getPiece();

        /* Position 3 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('DF3423', [8, 8], 'black'));

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]);
        $game->makeMove($game->getBoard()[8][4]->getPiece(), [7, 5]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [8, 5]);

        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

        /* Position 4 Black King */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('ESFTWE', [8, 1], 'black'));
        $game->getBoard()[1][5]->setPiece(new King('DSE332', [1, 5], 'white'));

        $game->getBoard()[8][8]->setPiece(new Rook('DF3423', [8, 8], 'black'));
        $game->getBoard()[8][1]->setPiece(new Rook('243D4C', [8, 1], 'black'));

        $game->makeMove($game->getBoard()[8][5]->getPiece(), [8, 4]);
        $game->makeMove($game->getBoard()[8][4]->getPiece(), [8, 5]);

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

        $game->getBoard()[1][8]->setPiece(new Rook('DF3423', [1, 8], 'white'));
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

        $game->getBoard()[1][8]->setPiece(new Rook('DF3423', [1, 8], 'white'));
        $game->getBoard()[2][6]->setPiece(new Knight('DSD23D', [2, 6], 'black'));
        $game->getBoard()[3][7]->setPiece(new Quenn('USTERS', [3, 7], 'black'));

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [3, 4]);

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

        $game->getBoard()[8][8]->setPiece(new Rook('DF34UU', [8, 8], 'black'));
        $game->getBoard()[7][3]->setPiece(new Knight('DSD23D', [7, 3], 'white'));

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

        $game->getBoard()[8][8]->setPiece(new Rook('DF34UU', [8, 8], 'black'));
        $game->getBoard()[6][3]->setPiece(new Quenn('DSD23D', [6, 3], 'white'));
        
        $games[2]['game'] = $game;
        $games[2]['king'] = $game->getBoard()[8][5]->getPiece();

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
}