<?php 

namespace App\Model;

use App\Model\Board;

class Game 
{
	private array $board;
	
	private array $moves;

	public function __construct()
	{
		$this->moves = [];
		$this->board = (new Board())->getBoard();
	}

	public function makeMove(object $piece, array $cords): void
	{
		/* Remove piece from square from wchich piece moved */
		$this->board[$piece->getCords()[0]][$piece->getCords()[1]] = null;

		/* Assign piece to a square to which piece moved */
		$this->board[$cords[0]][$cords[1]] = $piece;

		$this->moves[] = ['piece' => $piece, 'previous_cords' => $piece->getCords(), 'new_cords' => $cords];

		$piece->setCords($cords);
	}

	/**
	 * Get the value of moves
	 */ 
	public function getMoves()
	{
		return $this->moves;
	}

	/**
	 * Get the value of board
	 */ 
	public function getBoard()
	{
		return $this->board;
	}
}