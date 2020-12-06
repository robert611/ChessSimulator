<?php 

namespace App\Tests\Model;

use App\Model\Piece\Quenn;
use App\Model\Board;
use App\Model\Game;

use PHPUnit\Framework\TestCase;

class QuennTest extends TestCase
{
    public function testGetPossibleMoves()
    {
        $game = new Game();

        $board = $game->getBoard();

        /* It is starting position, there should be no possible moves for a quenn */
        $correctSet[0]['piece'] = $board[1][4]->getPiece();
        $correctSet[0]['possible_moves'] = [];
        $correctSet[0]['game'] = $game;

        $correctSet[1]['piece'] = $board[8][4]->getPiece();
        $correctSet[1]['possible_moves'] = [];
        $correctSet[1]['game'] = $game;

        /* It is a white quenn */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[1][4]->getPiece(), [4, 4]);

        $correctSet[2]['piece'] = $board[4][4]->getPiece();
        $correctSet[2]['possible_moves'] = [
            [4, 3], [4, 2], [4, 1],
            [5, 4], [6, 4], [7, 4],
            [4, 5], [4, 6], [4, 7], [4, 8], 
            [3, 4],
            [5, 3], [6, 2], [7, 1], 
            [5, 5], [6, 6], [7, 7],
            [3, 3],
            [3, 5],
        ];
        $correctSet[2]['game'] = $game;

        /* It is a black quenn */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[8][4]->getPiece(), [5, 5]);

        $correctSet[3]['piece'] = $board[5][5]->getPiece();
        $correctSet[3]['possible_moves'] = [
            [5, 4], [5, 3], [5, 2], [5, 1],
            [6, 5],
            [5, 6], [5, 7], [5, 8], 
            [4, 5], [3, 5], [2, 5],
            [6, 4], 
            [6, 6],
            [4, 4], [3, 3], [2, 2],
            [4, 6], [3, 7], [2, 8],
        ];
        $correctSet[3]['game'] = $game;
        
        foreach ($correctSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);

            $this->assertEquals($possibleMoves, $pair['possible_moves']);
        }

        foreach ($correctSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);
            $possibleMoves[] = [8, 8];

            $this->assertNotEquals($possibleMoves, $pair['possible_moves']);
        }
    }

    public function testIfQuennCannnotMoveLeavingKingInCheck()
    {
        $game = new Game();

        $board = $game->getBoard();

        /* White king and quenn */
        $game->makeMove($board[1][4]->getPiece(), [4, 4]);
        $game->makeMove($board[1][5]->getPiece(), [3, 5]);

        /* Black bishop pinning quenn */
        $game->makeMove($board[8][6]->getPiece(), [6, 2]);

        /* It is starting position */
        $correctSet[0]['piece'] = $board[4][4]->getPiece();
        $correctSet[0]['possible_moves'] = [[5, 3], [6, 2]];
        $correctSet[0]['game'] = $game;

        /* Set 2 with rook attacking our quenn behind which is placed our king */
        $game = new Game();
        $board = $game->getBoard();

        /* White king and rook */
        $game->makeMove($board[1][4]->getPiece(), [4, 5]);
        $game->makeMove($board[1][5]->getPiece(), [3, 5]);

        /* Black rook pinning quenn */
        $game->makeMove($board[8][8]->getPiece(), [6, 5]);

        $correctSet[1]['piece'] = $board[4][5]->getPiece();
        $correctSet[1]['possible_moves'] = [
            [5, 5], [6, 5]
        ];
        $correctSet[1]['game'] = $game;

        /* Set 3 white square bishop pins our quenn */
        $game = new Game();
        $board = $game->getBoard();

        /* White king and quenn */
        $game->makeMove($board[1][4]->getPiece(), [4, 3]);
        $game->makeMove($board[1][5]->getPiece(), [3, 4]);

        /* Black bishop pinning quenn */
        $game->makeMove($board[8][3]->getPiece(), [6, 1]);

        $correctSet[2]['piece'] = $board[4][3]->getPiece();
        $correctSet[2]['possible_moves'] = [[5, 2], [6, 1]];
        $correctSet[2]['game'] = $game;

        foreach ($correctSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);

            $this->assertEquals($possibleMoves, $pair['possible_moves']);
        }

        foreach ($correctSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);
            $pair['possible_moves'][] = [7, 7];

            $this->assertNotEquals($possibleMoves, $pair['possible_moves']);
        }
    }

    public function testGetProtectedSquares()
    {
        $game = new Game();

        $board = $game->getBoard();

        /* It is starting position */
        $correctSet[0]['piece'] = $board[1][4]->getPiece();
        $correctSet[0]['protected_squares'] = [
            [1, 3], [2, 4], [1, 5], [2, 3], [2, 5]
        ];
        $correctSet[0]['game'] = $game;

        $correctSet[1]['piece'] = $board[8][4]->getPiece();
        $correctSet[1]['protected_squares'] = [
            [8, 3], [8, 5], [7, 4], [7, 3], [7, 5]
        ];
        $correctSet[1]['game'] = $game;

        /* Set 3 */
        $game = new Game();
        $board = $game->getBoard();

        /* It is a white quenn */
        $game->makeMove($board[1][4]->getPiece(), [4, 3]);

        $correctSet[2]['piece'] = $board[4][3]->getPiece();
        $correctSet[2]['protected_squares'] = [
            [4, 2], [4, 1],
            [5, 3], [6, 3], [7, 3],
            [4, 4], [4, 5], [4, 6], [4, 7], [4, 8],
            [3, 3],
            [5, 2], [6, 1],
            [5, 4], [6, 5], [7, 6],
            [3, 2], 
            [3, 4],
            [2, 3], /* My proctected pieces are at the end of an array */
            [2, 1],
            [2, 5]
        ];
        $correctSet[2]['game'] = $game;

        /* It is a black quenn */
        $game->makeMove($board[8][4]->getPiece(), [4, 3]);

        $correctSet[3]['piece'] = $board[4][3]->getPiece();
        $correctSet[3]['protected_squares'] = $correctSet[2]['protected_squares'];
        $correctSet[3]['game'] = $game;

        foreach ($correctSet as $pair)
        {
            $protectedSquares = $pair['piece']->getProtectedSquares($pair['game']);

            sort($pair['protected_squares']);
            sort($protectedSquares);

            $this->assertEquals($protectedSquares, $pair['protected_squares']);
        }

        foreach ($correctSet as $pair)
        {
            $protectedSquares = $pair['piece']->getProtectedSquares($pair['game']);
            $protectedSquares[] = [1, 1];

            $this->assertNotEquals($protectedSquares, $pair['protected_squares']);
        }
    }

    public function testGetPotentialMovesCoordinates()
    {
        $board = (new Board())->getBoard();

        $board[4][4]->setPiece(clone $board[1][4]->getPiece());
        $board[4][4]->getPiece()->setCords([4, 4]);

        $correctSet[0]['piece'] = $board[4][4]->getPiece();
        $correctSet[0]['expected_moves']['left'] = [[4, 3], [4, 2], [4, 1]]; 
        $correctSet[0]['expected_moves']['up'] = [[5, 4], [6, 4], [7, 4], [8, 4]];
        $correctSet[0]['expected_moves']['right'] = [[4, 5], [4, 6], [4, 7], [4, 8]]; 
        $correctSet[0]['expected_moves']['down'] = [[3, 4], [2, 4], [1, 4]];
        $correctSet[0]['expected_moves']['up_and_left'] = [[5, 3], [6, 2], [7, 1]]; 
        $correctSet[0]['expected_moves']['up_and_right'] = [[5, 5], [6, 6], [7, 7], [8, 8]];
        $correctSet[0]['expected_moves']['down_and_left'] = [[3, 3], [2, 2], [1, 1]]; 
        $correctSet[0]['expected_moves']['down_and_right'] = [[3, 5], [2, 6], [1, 7]];

        $board[7][8]->setPiece(clone $board[1][4]->getPiece());
        $board[7][8]->getPiece()->setCords([7, 8]);

        $correctSet[1]['piece'] = $board[7][8]->getPiece();
        $correctSet[1]['expected_moves']['left'] = [[7, 7], [7, 6], [7, 5], [7, 4], [7, 3], [7, 2], [7, 1]]; 
        $correctSet[1]['expected_moves']['up'] = [[8, 8]];
        $correctSet[1]['expected_moves']['right'] = []; 
        $correctSet[1]['expected_moves']['down'] = [[6, 8], [5, 8], [4, 8], [3, 8], [2, 8], [1, 8]];
        $correctSet[1]['expected_moves']['up_and_left'] = [[8, 7]]; 
        $correctSet[1]['expected_moves']['up_and_right'] = [];
        $correctSet[1]['expected_moves']['down_and_left'] = [[6, 7], [5, 6], [4, 5], [3, 4], [2, 3], [1, 2]]; 
        $correctSet[1]['expected_moves']['down_and_right'] = [];


        foreach ($correctSet as $pair)
        {
            $potentialMovesCoordinates = $pair['piece']->getPotentialMovesCoordinates();
            $this->assertEquals($potentialMovesCoordinates, $pair['expected_moves']);
        }
    }
}