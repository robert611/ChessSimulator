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
		$this->getBoard()[$piece->getCords()[0]][$piece->getCords()[1]]->setPiece(null);

		/* Assign piece to a square to which piece moved */
		$this->getBoard()[$cords[0]][$cords[1]]->setPiece($piece);

		$this->moves[] = ['piece' => $piece, 'previous_cords' => $piece->getCords(), 'new_cords' => $cords];

		$piece->setCords($cords);
	}

	/* Note that only kings, queens and bishops can be recognized */
	public function getPieceSquare($name, $side, $squareColor = null): ?object
	{
		foreach ($this->getBoard() as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
				/* First compare name of piece */
				if (is_object($square->getPiece()) && $square->getPiece()->getName() == $name)
				{
					/* Secondly compare piece's side */
					if ($square->getPiece()->getSide() == $side) {

						/* If it is a bishop then square color is important */
						if (!is_null($squareColor) && $square->getColor() == $squareColor)
						{
							return $square;
						}
						else 
						{
							return $square; 
						}
					}
				}
			}
		}
		
		return null;
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
	public function getBoard(): array
	{
		return $this->board;
	}

	/**
	 * Set the value of board
	 *
	 * @return  self
	 */ 
	public function setBoard(array $board): self
	{
		$this->board = $board;

		return $this;
	}
}