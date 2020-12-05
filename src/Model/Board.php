<?php 

namespace App\Model;

use App\Model\BoardSquare;
use App\Model\SecretGenerator;
use App\Model\Piece\Pawn;
use App\Model\Piece\Rook;
use App\Model\Piece\Knight;
use App\Model\Piece\Bishop;
use App\Model\Piece\Quenn;
use App\Model\Piece\King;

class Board
{
    private array $board;

    private $secretGenerator;
    
    public function __construct()
    {
        $this->secretGenerator = new SecretGenerator();
        $this->makeBoard();
    }

    private function makeBoard()
    {
        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                if ($i % 2 == 0 && $j % 2 !== 0) {
                    $color = 'white';
                }
                else if($i % 2 !== 0 && $j % 2 == 0) {
                    $color = 'white';
                }
                else {
                    $color = 'black';
                }

                $this->board[$i][$j] = new BoardSquare([$i, $j], null, $color);
            }
        }

        $this->fillBoard();
    }

    private function fillBoard()
    {
        $this->board[1][1]->setPiece(new Rook($this->secretGenerator->generate(), [1,1], 'white'));
        $this->board[1][2]->setPiece(new Knight($this->secretGenerator->generate(), [1,2], 'white'));
        $this->board[1][3]->setPiece(new Bishop($this->secretGenerator->generate(), [1,3], 'white'));
        $this->board[1][4]->setPiece(new Quenn($this->secretGenerator->generate(), [1,4], 'white'));
        $this->board[1][5]->setPiece(new King($this->secretGenerator->generate(), [1,5], 'white'));
        $this->board[1][6]->setPiece(new Bishop($this->secretGenerator->generate(), [1,6], 'white'));
        $this->board[1][7]->setPiece(new Knight($this->secretGenerator->generate(), [1,7], 'white'));
        $this->board[1][8]->setPiece(new Rook($this->secretGenerator->generate(), [1,8], 'white'));

        for ($i = 1; $i <= 8; $i++) {
            $this->board[2][$i]->setPiece(new Pawn($this->secretGenerator->generate(), [2, $i], 'white'));
        }

        for ($k = 3; $k <= 6; $k++) {
            for ($j = 1; $j <= 8; $j++) {
                $this->board[$k][$j]->setPiece(null);
            }
        }

        for ($f = 1; $f <= 8; $f++) {
            $this->board[7][$f]->setPiece(new Pawn($this->secretGenerator->generate(), [7, $f], 'black'));
        }

        $this->board[8][1]->setPiece(new Rook($this->secretGenerator->generate(), [8,1], 'black'));
        $this->board[8][2]->setPiece(new Knight($this->secretGenerator->generate(), [8,2], 'black'));
        $this->board[8][3]->setPiece(new Bishop($this->secretGenerator->generate(), [8,3], 'black'));
        $this->board[8][4]->setPiece(new Quenn($this->secretGenerator->generate(), [8,4], 'black'));
        $this->board[8][5]->setPiece(new King($this->secretGenerator->generate(), [8,5], 'black'));
        $this->board[8][6]->setPiece(new Bishop($this->secretGenerator->generate(), [8,6], 'black'));
        $this->board[8][7]->setPiece(new Knight($this->secretGenerator->generate(), [8,7], 'black'));
        $this->board[8][8]->setPiece(new Rook($this->secretGenerator->generate(), [8,8], 'black'));
    }

    /**
     * Get the value of board
     */ 
    public function getBoard()
    {
        return $this->board;
    }

    public function recreateBoard(array $board): array
    {
        $newBoard = array();

        for ($k = 1; $k <= 8; $k++) {
            for ($j = 1; $j <= 8; $j++) {
                $newBoard[$k][$j] = clone $board[$k][$j];
            }
        }

        return $newBoard;
    }
}