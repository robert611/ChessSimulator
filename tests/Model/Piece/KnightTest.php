<?php 

namespace App\Tests\Model;

use App\Model\Piece\Rook;
use App\Model\Board;
use App\Model\Game;

use PHPUnit\Framework\TestCase;

class KnightTest extends TestCase 
{
    public function testGetPossibleMoves()
    {
        $game = new Game();

        $board = $game->getBoard();

        $correctSet[0]['piece'] = $board[1][2]->getPiece();
        $correctSet[0]['possible_moves'] = [[3, 1], [3, 3]];
        $correctSet[0]['game'] = $game;

        $correctSet[1]['piece'] = $board[8][2]->getPiece();
        $correctSet[1]['possible_moves'] = [[6, 1], [6, 3]];
        $correctSet[1]['game'] = $game;

        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[8][2]->getPiece(), [4, 4]);

        $correctSet[2]['piece'] = $board[4][4]->getPiece();
        $correctSet[2]['possible_moves'] = [
            [6, 3], [6, 5],
            [5, 2], [5, 6],
            [3, 2], [3, 6],
            [2, 3], [2, 5]
        ];
        $correctSet[2]['game'] = $game;
        
        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[1][2]->getPiece(), [3, 2]);

        $correctSet[3]['piece'] = $board[3][2]->getPiece();
        $correctSet[3]['possible_moves'] = [
            [5, 1], [5, 3],
            [4, 4],
        ];
        $correctSet[3]['game'] = $game;

        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[8][7]->getPiece(), [5, 7]);

        $correctSet[4]['piece'] = $board[5][7]->getPiece();
        $correctSet[4]['possible_moves'] = [
            [6, 5], [4, 5],
            [3, 6], [3, 8]
        ];
        $correctSet[4]['game'] = $game;

        $game = new Game();
        $board = $game->getBoard();
        $game->makeMove($board[1][7]->getPiece(), [4, 8]);

        $correctSet[5]['piece'] = $board[4][8]->getPiece();
        $correctSet[5]['possible_moves'] = [
            [6, 7], [5, 6],            
            [3, 6]
        ];
        $correctSet[5]['game'] = $game;

        foreach ($correctSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);

            sort($pair['possible_moves']);
            sort($possibleMoves);

            $this->assertEquals($possibleMoves, $pair['possible_moves']);
        }

        foreach ($correctSet as $pair)
        {
            $possibleMoves = $pair['piece']->getPossibleMoves($pair['game']);
            $possibleMoves[] = [1, 1];

            sort($pair['possible_moves']);
            sort($possibleMoves);
            
            $this->assertNotEquals($possibleMoves, $pair['possible_moves']);
        }
    }

    public function testIfQuennCannnotMoveLeavingKingInCheck()
    {
        $game = new Game();

        $board = $game->getBoard();

        /* White king and knight */
        $game->makeMove($board[1][2]->getPiece(), [4, 4]);
        $game->makeMove($board[1][5]->getPiece(), [3, 5]);

        /* Black bishop pinning knight */
        $game->makeMove($board[8][6]->getPiece(), [6, 2]);

        /* It is a starting position */
        $correctSet[0]['piece'] = $board[4][4]->getPiece();
        $correctSet[0]['possible_moves'] = [];
        $correctSet[0]['game'] = $game;

        /* Set 2 with rook attacking our knight behind which is placed our king */
        $game = new Game();
        $board = $game->getBoard();

        /* White king and rook */
        $game->makeMove($board[1][2]->getPiece(), [4, 5]);
        $game->makeMove($board[1][5]->getPiece(), [3, 5]);

        /* Black rook pinning quenn */
        $game->makeMove($board[8][8]->getPiece(), [6, 5]);

        $correctSet[1]['piece'] = $board[4][5]->getPiece();
        $correctSet[1]['possible_moves'] = [];
        $correctSet[1]['game'] = $game;

        /* Set 3 white square bishop pins our knight */
        $game = new Game();
        $board = $game->getBoard();

        /* White king and quenn */
        $game->makeMove($board[1][7]->getPiece(), [4, 3]);
        $game->makeMove($board[1][5]->getPiece(), [3, 4]);

        /* Black bishop pinning knight */
        $game->makeMove($board[8][3]->getPiece(), [6, 1]);

        $correctSet[2]['piece'] = $board[4][3]->getPiece();
        $correctSet[2]['possible_moves'] = [];
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

        /* It is a starting position */
        $correctSet[0]['piece'] = $board[1][2]->getPiece();
        $correctSet[0]['protected_squares'] = [
            [3, 1], [3, 3], [2, 4]
        ];
        $correctSet[0]['game'] = $game;

        $correctSet[1]['piece'] = $board[8][2]->getPiece();
        $correctSet[1]['protected_squares'] = [
            [7, 4], [6, 1], [6, 3]
        ];
        $correctSet[1]['game'] = $game;

        /* Set 3*/
        $game = new Game();
        $board = $game->getBoard();

        /* It is a white rook */
        $game->makeMove($board[1][7]->getPiece(), [5, 4]);

        $correctSet[2]['piece'] = $board[5][4]->getPiece();
        $correctSet[2]['protected_squares'] = [
            [7, 3], [7, 5],
            [6, 2], [6, 6],
            [4, 2], [4, 6],
            [3, 3], [3, 5]
        ];
        $correctSet[2]['game'] = $game;

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

            sort($pair['protected_squares']);
            sort($protectedSquares);
            
            $this->assertNotEquals($protectedSquares, $pair['protected_squares']);
        }
    }

    public function testGetPotentialMovesCoordinates()
    {
        $board = (new Board())->getBoard();

        $correctSet[0]['piece'] = $board[1][2]->getPiece();
        $correctSet[0]['expected_moves']['two_up_and_left'] = [3, 1]; 
        $correctSet[0]['expected_moves']['two_up_and_right'] = [3, 3];
        $correctSet[0]['expected_moves']['one_up_and_two_left'] = []; 
        $correctSet[0]['expected_moves']['one_up_and_two_right'] = [2, 4];
        $correctSet[0]['expected_moves']['two_down_and_left'] = [];
        $correctSet[0]['expected_moves']['two_down_and_right'] = [];
        $correctSet[0]['expected_moves']['one_down_and_two_left'] = [];
        $correctSet[0]['expected_moves']['one_down_and_two_right'] = [];

        $board[4][4]->setPiece(clone $board[1][2]->getPiece());
        $board[4][4]->getPiece()->setCords([4, 4]);

        $correctSet[1]['piece'] = $board[4][4]->getPiece();
        $correctSet[1]['expected_moves']['two_up_and_left'] = [6, 3]; 
        $correctSet[1]['expected_moves']['two_up_and_right'] = [6, 5];
        $correctSet[1]['expected_moves']['one_up_and_two_left'] = [5, 2]; 
        $correctSet[1]['expected_moves']['one_up_and_two_right'] = [5, 6];
        $correctSet[1]['expected_moves']['two_down_and_left'] = [2, 3];
        $correctSet[1]['expected_moves']['two_down_and_right'] = [2, 5];
        $correctSet[1]['expected_moves']['one_down_and_two_left'] = [3, 2];
        $correctSet[1]['expected_moves']['one_down_and_two_right'] = [3, 6];

        $correctSet[2]['piece'] = $board[8][7]->getPiece();
        $correctSet[2]['expected_moves']['two_up_and_left'] = []; 
        $correctSet[2]['expected_moves']['two_up_and_right'] = [];
        $correctSet[2]['expected_moves']['one_up_and_two_left'] = []; 
        $correctSet[2]['expected_moves']['one_up_and_two_right'] = [];
        $correctSet[2]['expected_moves']['two_down_and_left'] = [6, 6];
        $correctSet[2]['expected_moves']['two_down_and_right'] = [6, 8];
        $correctSet[2]['expected_moves']['one_down_and_two_left'] = [7, 5];
        $correctSet[2]['expected_moves']['one_down_and_two_right'] = [];

        $wrongSet[0]['piece'] = $board[8][2]->getPiece();
        $wrongSet[0]['expected_moves']['two_up_and_left'] = []; 
        $wrongSet[0]['expected_moves']['two_up_and_right'] = [];
        $wrongSet[0]['expected_moves']['one_up_and_two_left'] = []; 
        $wrongSet[0]['expected_moves']['one_up_and_two_right'] = [];
        $wrongSet[0]['expected_moves']['two_down_and_left'] = [6, 1];
        $wrongSet[0]['expected_moves']['two_down_and_right'] = [6, 4]; // Should be 6, 3
        $wrongSet[0]['expected_moves']['one_down_and_two_left'] = [];
        $wrongSet[0]['expected_moves']['one_down_and_two_right'] = [7, 4];

        $board[5][3]->setPiece(clone $board[1][2]->getPiece());
        $board[5][3]->getPiece()->setCords([5, 3]);

        $wrongSet[1]['piece'] = $board[5][3]->getPiece();
        $wrongSet[1]['expected_moves']['two_up_and_left'] = [7, 2]; 
        $wrongSet[1]['expected_moves']['two_up_and_right'] = [7, 4];
        $wrongSet[1]['expected_moves']['one_up_and_two_left'] = [6, 1]; 
        $wrongSet[1]['expected_moves']['one_up_and_two_right'] = [6, 5];
        $wrongSet[1]['expected_moves']['two_down_and_left'] = [3, 2];
        $wrongSet[1]['expected_moves']['two_down_and_right'] = [3, 4];
        $wrongSet[1]['expected_moves']['one_down_and_two_left'] = [4, 1];
        $wrongSet[1]['expected_moves']['one_down_and_two_right'] = [4, 8]; // Should be 4, 5

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