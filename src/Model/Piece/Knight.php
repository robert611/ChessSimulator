<?php

namespace App\Model\Piece;

class Knight extends Piece
{
	private string $id;

	private string $name = 'knight';
	
	private string $picture;
	
	private array $cords;
	
	private string $side;

	public function __construct(string $id, array $cords, string $side)
	{
		$this->id = $id;
		$this->cords = $cords;
		$this->side = $side;
	}

	public function move(object $game)
	{
		$possibleMoves = $this->getPossibleMoves($game);

		return $possibleMoves;
	}

	public function findOutPossibleMovesAndProtectedSquares(object $game): array
	{
		$board = $game->getBoard();

		$possibleMoves = [];

		$protectedSquares = [];

		$potentialMovesCoordinates = $this->getPotentialMovesCoordinates();

		foreach($potentialMovesCoordinates as $potentialMove) 
		{
			if (empty($potentialMove)) continue;
			
			/* These are coordination we check in current loop cycle if bishop can move there */
			$pieceOnSquare = $board[$potentialMove[0]][$potentialMove[1]]->getPiece();

			/* If in a given coordinates is placed an opponent piece, then add it to possible moves */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() !== $this->getSide())
			{
				$possibleMoves[] = $potentialMove;
			}

			if ($pieceOnSquare == null)
			{
				$possibleMoves[] = $potentialMove;
			}

			/* In this case we try to hit our own piece, so we can't go this way, and it means we are protecting that piece */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $this->getSide()) {
				$protectedSquares[] = $potentialMove;
			}
		}

		/* $protectedSquares on its own contains only squares on which our pieces are, $possibleMoves contains all of the other moves like empty squares or oponnent pieces */
		return ['possible_moves' => $possibleMoves, 'protected_squares' => array_merge($possibleMoves, $protectedSquares)];
	}

	public function getPotentialMovesCoordinates(): array
	{
        /*
            $cords[0] is horizontal column
            $cords[1] is vertical column
		*/
		
		$potentialMoves = [];

		/* Knigt moves form the shape of an L, While moving the knight can jump over pieces */
		/* At best knight can have 8 possible moves */

		$potentialMoves['two_up_and_left'] = [$this->cords[0] + 2, $this->cords[1] - 1];
		$potentialMoves['two_up_and_right'] = [$this->cords[0] + 2, $this->cords[1] + 1];
		$potentialMoves['one_up_and_two_left'] = [$this->cords[0] + 1, $this->cords[1] - 2];
		$potentialMoves['one_up_and_two_right'] = [$this->cords[0] + 1, $this->cords[1] + 2];
		$potentialMoves['two_down_and_left'] = [$this->cords[0] - 2, $this->cords[1] - 1];
		$potentialMoves['two_down_and_right'] = [$this->cords[0] - 2, $this->cords[1] + 1];
		$potentialMoves['one_down_and_two_left'] = [$this->cords[0] - 1, $this->cords[1] - 2];
		$potentialMoves['one_down_and_two_right'] = [$this->cords[0] - 1, $this->cords[1] + 2];

		$sorted = [];

		foreach ($potentialMoves as $key => $move)
		{
			if (!$this->checkIfCoordinatesAreInsideOfBoard($move[0], $move[1])) {
				$sorted[$key] = [];

				continue;
			};

			$sorted[$key] = $move;
		}
		
		return $sorted;
    }

	public function getPicture(): string
	{
		return $this->side . "-" . $this->name . ".png";
	}

	public function setPicture(string $picture): self
	{
		$this->picture = $picture;

		return $this;
	}

	public function getSide(): string
	{
		return $this->side;
	}

	public function setSide(string $side): self
	{
		$this->side = $side;

		return $this;
	}
 
	public function getCords(): array
	{
		return $this->cords;
	}
 
	public function setCords(array $cords): self
	{
		$this->cords = $cords;

		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}
}