<?php 

namespace App\Model;

use App\Model\Piece\Pawn;
use App\Model\Piece\Rook;
use App\Model\Piece\Knight;
use App\Model\Piece\Bishop;
use App\Model\Piece\Quenn;
use App\Model\Piece\King;

class Board 
{
    private array $board;

	public function __construct()
	{
		$this->makeBoard();
	}

	private function makeBoard()
	{
		for($i = 1; $i <= 8; $i++)
		{
			for($j = 1; $j <= 8; $j++)
			{
				$this->board[$i][$j] = null;
			}
		}

		$this->fillBoard();
	}

	private function fillBoard()
	{
		$this->board[1][1] = new Rook([1,1], 'white'); 
		$this->board[1][2] = new Knight([1,2], 'white'); 
		$this->board[1][3] = new Bishop([1,3], 'white'); 
		$this->board[1][4] = new Quenn([1,4], 'white'); 
		$this->board[1][5] = new King([1,5], 'white'); 
		$this->board[1][6] = new Bishop([1,6], 'white'); 
		$this->board[1][7] = new Knight([1,7], 'white'); 
		$this->board[1][8] = new Rook([1,8], 'white'); 


		for($i = 1; $i <= 8; $i++)
		{
			$this->board[2][$i] = new Pawn([2, $i], 'white');
		}

		for($k = 3; $k <= 6; $k++)
		{
			for($j = 1; $j <= 8; $j++)
			{
				$this->board[$k][$j] = null;
			}	
		}


		for($f = 1; $f <= 8; $f++)
		{
			$this->board[7][$f] = new Pawn([7, $f], 'black');
		}

		$this->board[8][1] = new Rook([8,1], 'black'); 
		$this->board[8][2] = new Knight([8,2], 'black'); 
		$this->board[8][3] = new Bishop([8,3], 'black'); 
		$this->board[8][4] = new Quenn([8,4], 'black'); 
		$this->board[8][5] = new King([8,5], 'black'); 
		$this->board[8][6] = new Bishop([8,6], 'black'); 
		$this->board[8][7] = new Knight([8,7], 'black'); 
		$this->board[8][8] = new Rook([8,8], 'black');
	}

	public function makeMove()
	{
		
	}

    /**
     * Get the value of board
     */ 
    public function getBoard()
    {
        return $this->board;
    }
}