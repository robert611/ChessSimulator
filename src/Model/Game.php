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

	public function playGame()
	{
		$whiteKing = $this->getPieceSquare('king', 'white')->getPiece();
		$blackKing = $this->getPieceSquare('king', 'black')->getPiece();

		$movingSide = 'white';

		$iteration = 1;

		do {
			/* Every piece has access to that method from abstract class piece */
			$sidePossibleMoves = $whiteKing->getGivenSidePossibleMoves($this, $movingSide);

			do {
				$movingPiece = $sidePossibleMoves[array_rand($sidePossibleMoves)];

				$move = null;
	
				if (!empty($movingPiece['possible_moves'])) {
					$move = $movingPiece['possible_moves'][array_rand($movingPiece['possible_moves'])];
				}
			}
			while (is_null($move));
			
			$this->makeMove($movingPiece['piece'], $move);

			/* If white then black, and if black then white */
			$movingSide = $movingSide == 'white' ? 'black' : 'white';

			$iteration++;
		} while(!$whiteKing->checkIfKingIsInCheckmate($this) && !$blackKing->checkIfKingIsInCheckmate($this) && $iteration <= 120);
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