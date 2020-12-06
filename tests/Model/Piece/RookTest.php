<?php 

namespace App\Tests\Model;

use App\Model\Piece\Rook;
use App\Model\Board;
use App\Model\Game;

use PHPUnit\Framework\TestCase;

class RookTest extends TestCase 
{
    public function testPossibleMoves()
    {
        $game = new Game();

        $board = $game->getBoard();

        /* It is starting position, there should be not possible moves for a rook */
        $correctSet[0]['piece'] = $board[8][8]->getPiece();
        $correctSet[0]['possible_moves'] = [];
        $correctSet[0]['game'] = $game;

        $correctSet[1]['piece'] = $board[8][1]->getPiece();
        $correctSet[1]['possible_moves'] = [];
        $correctSet[1]['game'] = $game;

        /* It is a black rook */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[8][1]->getPiece(), [4, 4]);

        $correctSet[2]['piece'] = $board[4][4]->getPiece();
        $correctSet[2]['possible_moves'] = [
            [4, 3], [4, 2], [4, 1],
            [5, 4], [6, 4],
            [4, 5], [4, 6], [4, 7], [4, 8],
            [3, 4], [2, 4]
        ];
        $correctSet[2]['game'] = $game;
        
        /* It is a black rook */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[8][1]->getPiece(), [3, 2]);

        $correctSet[3]['piece'] = $board[3][2]->getPiece();
        $correctSet[3]['possible_moves'] = [
            [3, 1],
            [4, 2], [5, 2], [6, 2],
            [3, 3], [3, 4], [3, 5], [3, 6], [3, 7], [3, 8],
            [2, 2]
        ];
        $correctSet[3]['game'] = $game;

        /* It is a white rook */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[1][1]->getPiece(), [8, 2]);

        $correctSet[4]['piece'] = $board[8][2]->getPiece();
        $correctSet[4]['possible_moves'] = [
            [8, 1],
            [8, 3],
            [7, 2]
        ];
        $correctSet[4]['game'] = $game;

        /* It is a white rook */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[1][8]->getPiece(), [4, 8]);

        $correctSet[5]['piece'] = $board[4][8]->getPiece();
        $correctSet[5]['possible_moves'] = [
            [4, 7], [4, 6], [4, 5], [4, 4], [4, 3], [4, 2], [4, 1],            
            [5, 8], [6, 8], [7, 8],
            [3, 8],
        ];
        $correctSet[5]['game'] = $game;

        foreach ($correctSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);

            $this->assertEquals($possibleMoves, $pair['possible_moves']);
        }
    }

    public function testGetPossibleMovesAgainstWrongData()
    {
        $game = new Game();

        $board = $game->getBoard();

        /* It is starting position, there should be not possible moves for a rook */
        $wrongSet[0]['piece'] = $board[8][8]->getPiece();
        $wrongSet[0]['possible_moves'] = [
            [1, 8]
        ];
        $wrongSet[0]['game'] = $game;

        $wrongSet[1]['piece'] = $board[8][1]->getPiece();
        $wrongSet[1]['possible_moves'] = [
            [1, 1], [3, 6]
        ];
        $wrongSet[1]['game'] = $game;

        /* It is a white rook */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[1][8]->getPiece(), [3, 2]);

        $wrongSet[2]['piece'] = $board[3][2]->getPiece();
        $wrongSet[2]['possible_moves'] = [
            [3, 1],
            [4, 2], [5, 2], [6, 2], [7, 2],
            [3, 3], [3, 4], [3, 5], [3, 6], [3, 7], [3, 8],
            [3, 2]
        ];
        $wrongSet[2]['game'] = $game;

        /* It is a black rook */
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[8][1]->getPiece(), [4, 6]);

        $wrongSet[3]['piece'] = $board[4][6]->getPiece();
        $wrongSet[3]['possible_moves'] = [
            [4, 5], [4, 4], [4, 3], [4, 2], [4, 1],
            [5, 6], [6, 6], [7, 6], // <- wrong,
            [4, 7], [4, 8],
            [3, 6], [2, 6]
        ];
        $wrongSet[3]['game'] = $game;

        foreach ($wrongSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);

            $this->assertNotEquals($possibleMoves, $pair['possible_moves']);
        }
    }

    public function testIfRookCannnotMoveLeavingKingInCheck()
    {
        $game = new Game();

        $board = $game->getBoard();

        /* White king and rook */
        $game->makeMove($board[1][1]->getPiece(), [4, 4]);
        $game->makeMove($board[1][5]->getPiece(), [3, 5]);

        /* Black bishop pinning rook */
        $game->makeMove($board[8][6]->getPiece(), [6, 2]);

        /* It is starting position, there should be not possible moves for a rook */
        $correctSet[0]['piece'] = $board[4][4]->getPiece();
        $correctSet[0]['possible_moves'] = [];
        $correctSet[0]['game'] = $game;

        /* Set 2 with rook attacking our rook behind which is placed our king */
        $game = new Game();
        $board = $game->getBoard();

        /* White king and rook */
        $game->makeMove($board[1][1]->getPiece(), [4, 5]);
        $game->makeMove($board[1][5]->getPiece(), [3, 5]);

        /* Black rook pinning rook */
        $game->makeMove($board[8][8]->getPiece(), [6, 5]);

        /* It is starting position, there should be not possible moves for a rook */
        $correctSet[1]['piece'] = $board[4][5]->getPiece();
        $correctSet[1]['possible_moves'] = [
            [5, 5], [6, 5]
        ];
        $correctSet[1]['game'] = $game;

        /* Set 3 white square bishop pins our rook */
        $game = new Game();
        $board = $game->getBoard();

        /* White king and rook */
        $game->makeMove($board[1][1]->getPiece(), [4, 3]);
        $game->makeMove($board[1][5]->getPiece(), [3, 4]);

        /* Black bishop pinning rook */
        $game->makeMove($board[8][3]->getPiece(), [6, 1]);

        /* It is starting position, there should be not possible moves for a rook */
        $correctSet[1]['piece'] = $board[4][3]->getPiece();
        $correctSet[1]['possible_moves'] = [];
        $correctSet[1]['game'] = $game;

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
        $correctSet[0]['piece'] = $board[8][8]->getPiece();
        $correctSet[0]['protected_squares'] = [
            [8, 7], [7, 8]
        ];
        $correctSet[0]['game'] = $game;

        $correctSet[1]['piece'] = $board[8][1]->getPiece();
        $correctSet[1]['protected_squares'] = [
            [8, 2], [7, 1]
        ];
        $correctSet[1]['game'] = $game;

        /* Set 3*/
        $game = new Game();
        $board = $game->getBoard();

        /* It is a white rook */
        $game->makeMove($board[1][1]->getPiece(), [4, 3]);

        $correctSet[2]['piece'] = $board[4][3]->getPiece();
        $correctSet[2]['protected_squares'] = [
            [4, 2], [4, 1],
            [5, 3], [6, 3], [7, 3],
            [4, 4], [4, 5], [4, 6], [4, 7], [4, 8],
            [3, 3], [2, 3]
        ];
        $correctSet[2]['game'] = $game;

        foreach ($correctSet as $pair)
        {
            $protectedSquares = $pair['piece']->getProtectedSquares($pair['game']);

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

        /* It's a starting position so rooks will be [1,1], [1, 8], [8, 1], [8, 8] */

        $correctSet[0]['piece'] = $board[8][8]->getPiece();
        $correctSet[0]['expected_moves']['left'] = [[8, 7], [8, 6], [8, 5], [8, 4], [8, 3], [8, 2], [8, 1]]; 
        $correctSet[0]['expected_moves']['up'] = [];
        $correctSet[0]['expected_moves']['right'] = []; 
        $correctSet[0]['expected_moves']['down'] = [[7, 8], [6, 8], [5, 8], [4, 8], [3, 8], [2, 8], [1, 8]];

        $board[4][4]->setPiece(clone $board[8][1]->getPiece());
        $board[4][4]->getPiece()->setCords([4, 4]);

        $correctSet[1]['piece'] = $board[4][4]->getPiece();
        $correctSet[1]['expected_moves']['left'] = [[4, 3], [4, 2], [4, 1]]; 
        $correctSet[1]['expected_moves']['up'] = [[5, 4], [6, 4], [7, 4], [8, 4]];
        $correctSet[1]['expected_moves']['right'] = [[4, 5], [4, 6], [4, 7], [4, 8]]; 
        $correctSet[1]['expected_moves']['down'] = [[3, 4], [2, 4], [1, 4]];

        $correctSet[2]['piece'] = $board[1][1]->getPiece();
        $correctSet[2]['expected_moves']['left'] = []; 
        $correctSet[2]['expected_moves']['up'] = [[2, 1], [3, 1], [4, 1], [5, 1], [6, 1], [7, 1], [8, 1]];
        $correctSet[2]['expected_moves']['right'] = [[1, 2], [1, 3], [1, 4], [1, 5], [1, 6], [1, 7], [1, 8]]; 
        $correctSet[2]['expected_moves']['down'] = [];

        $wrongSet[0]['piece'] = $board[1][8]->getPiece();
        $wrongSet[0]['expected_moves']['left'] = []; 
        $wrongSet[0]['expected_moves']['up'] = [[2, 8], [3, 8], [4, 8], [5, 8], [6, 8], [7, 8], [8, 8]];
        $wrongSet[0]['expected_moves']['right'] = []; 
        $wrongSet[0]['expected_moves']['down'] = [];

        $wrongSet[1]['piece'] = $board[8][1]->getPiece();
        $wrongSet[1]['expected_moves']['left'] = []; 
        $wrongSet[1]['expected_moves']['up'] = [];
        $wrongSet[1]['expected_moves']['right'] = [[8, 2], [8, 3], [8, 4], [8, 5], [8, 6], [8, 7], [8, 8]]; 
        $wrongSet[1]['expected_moves']['down'] = [[7, 1], [6, 1]];

        foreach ($correctSet as $pair)
        {
            $potentialMovesCoordinates = $pair['piece']->getPotentialMovesCoordinates();
            $this->assertEquals($potentialMovesCoordinates, $pair['expected_moves']);
        }

        foreach ($wrongSet as $pair)
        {
            $potentialMovesCoordinates = $pair['piece']->getPotentialMovesCoordinates();
            $this->assertNotEquals($potentialMovesCoordinates, $pair['expected_moves']);
        }
    }
}

