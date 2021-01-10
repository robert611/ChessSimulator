<?php

namespace App\Model\Piece;

class Rook extends Piece
{
	private string $id;

	private string $name = 'rook';

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

		/* Rook can move horizontally or vertically */

		$potentialMoves = $this->getPotentialMovesCoordinates();

		/* Potential moves are sorted by direction in its own arrays with names [left, up, right, down] */
		foreach ($potentialMoves as $direction)
		{
			foreach ($direction as $move)
			{
				/* These are coordination we check in current loop cycle if bishop can move there */
				$pieceOnSquare = $board[$move[0]][$move[1]]->getPiece();

				/* If in a given coordinates is placed an opponent piece, then add it to possible moves and break since we can't go further on this diagonal */
				if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() !== $this->getSide())
				{
					$possibleMoves[] = $move;
					break;
				}

				if ($pieceOnSquare == null)
				{
					$possibleMoves[] = $move;
				}

				/* In this case we try to hit our own piece, so we can't go this way or any further on this diagonal, and it means we are protecting that piece */
				if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $this->getSide()) {
					$protectedSquares[] = $move;
					break;
				}
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

		$potentialMoves = ['left' => [], 'up' => [], 'right' => [], 'down' => []];

		/* left */
		for($verticalSquareNumber = $this->cords[1] - 1; $verticalSquareNumber >= 1; $verticalSquareNumber--)
		{
			$potentialMoves['left'][] = [$this->cords[0], $verticalSquareNumber];
		}

		/* up */
		for($horizontalSquareNumber = $this->cords[0] + 1; $horizontalSquareNumber <= 8; $horizontalSquareNumber++)
		{
			$potentialMoves['up'][] = [$horizontalSquareNumber, $this->cords[1]];
		}

		/* right */
		for($verticalSquareNumber = $this->cords[1] + 1; $verticalSquareNumber <= 8; $verticalSquareNumber++)
		{
			$potentialMoves['right'][] = [$this->cords[0], $verticalSquareNumber];
		}

		/* down */
		for($horizontalSquareNumber = $this->cords[0] - 1; $horizontalSquareNumber >= 1; $horizontalSquareNumber--)
		{
			$potentialMoves['down'][] = [$horizontalSquareNumber, $this->cords[1]];
		}

		return $potentialMoves;
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

	public function getId(): string
	{
		return $this->id;
	}
}