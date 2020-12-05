<?php

namespace App\Model\Piece;

class Bishop extends Piece
{
	private string $id;

	private string $name = 'bishop';
	
	private string $picture;
	
	private array $cords; /* $cords[0] -> number, $cords[1] -> letter, for instance: $cords[0] = 2, $cords[1] = a */ 
	
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

		/* Bishop moves on diagonals, it can be: [up, left] , [up, right], [down, left], [down, right] */

		/* If a bishop blocks opponents's piece attack on our king then he can't move since it would be check */
		
		/*
			$cords[0] is horizontal column
			$cords[1] is vertical column
		*/
		
		/* [up, left] diagonal */
		for($horizontalSquareNumber = $this->cords[0] + 1, $iteration = 1; $horizontalSquareNumber <= 8; $horizontalSquareNumber++, $iteration++)
		{
			/* Going up left we will decrease our position on vertical column, and increase on horizontal column */

			if (!$this->checkIfCoordinatesAreInsideOfBoard($horizontalSquareNumber, $this->cords[1] - $iteration)) break;

			/* These are coordination we check in current loop cycle if bishop can move there */
			$checkedCoordination = [$horizontalSquareNumber, $this->cords[1] - $iteration];
			$pieceOnSquare = $board[$horizontalSquareNumber][$this->cords[1] - $iteration]->getPiece();

			/* If in a given coordinates is placed an opponent piece, then add it to possible moves and break since we can't go further on this diagonal */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() !== $this->getSide())
			{
				$possibleMoves[] = $checkedCoordination;
				break;
			}

			if ($pieceOnSquare == null)
			{
				$possibleMoves[] = $checkedCoordination;
			}

			/* In this case we try to hit our own piece, so we can't go this way or any further on this diagonal, and it means we are protecting that piece */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $this->getSide()) {
				$protectedSquares[] = $checkedCoordination;
				break;
			}

			/* It will apply if we are on A8, C8, E8, G8, A6, A4, A2 position then you can't go further up, because it is the end of a board */
			if ($horizontalSquareNumber == 1 or $this->cords[1] - $iteration == 8) break; 
		}

		/* [down, right] diagonal */
		for($horizontalSquareNumber = $this->cords[0] - 1, $iteration = 1; $horizontalSquareNumber >= 1; $horizontalSquareNumber--, $iteration++)
		{
			/* Going down left we will increase our position on vertical column, and decrease on horizontal column */

			if (!$this->checkIfCoordinatesAreInsideOfBoard($horizontalSquareNumber, $this->cords[1] + $iteration)) break;

			/* These are coordination we check in current loop cycle if bishop can move there */
			$checkedCoordination = [$horizontalSquareNumber, $this->cords[1] + $iteration];
			$pieceOnSquare = $board[$horizontalSquareNumber][$this->cords[1] + $iteration]->getPiece();

			/* If in a given coordinates is placed an opponent piece, then add it to possible moves and break since we can't go further on this diagonal */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() !== $this->getSide())
			{
				$possibleMoves[] = $checkedCoordination;
				break;
			}

			if ($pieceOnSquare == null)
			{
				$possibleMoves[] = $checkedCoordination;
			}

			/* In this case we try to hit our own piece, so we can't go this way or any further on this diagonal, and it means we are protecting that piece */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $this->getSide()) {
				$protectedSquares[] = $checkedCoordination;
				break;
			}

			/* It will apply if we are on B1, D1, F1, H1, H3, H5, H7 position then you can't go further up, because it is the end of a board */
			if ($horizontalSquareNumber == 1 or $this->cords[1] + $iteration == 1) break; 
		}

		/* [up, right] diagonal */
		for($horizontalSquareNumber = $this->cords[0] + 1, $iteration = 1; $horizontalSquareNumber <= 8; $horizontalSquareNumber++, $iteration++)
		{
			/* Going up right we will increase our position on vertical column, and increase on horizontal column */
			
			if (!$this->checkIfCoordinatesAreInsideOfBoard($horizontalSquareNumber, $this->cords[1] + $iteration)) break;

			/* These are coordination we check in current loop cycle if bishop can move there */
			$checkedCoordination = [$horizontalSquareNumber, $this->cords[1] + $iteration];
			$pieceOnSquare = $board[$horizontalSquareNumber][$this->cords[1] + $iteration]->getPiece();

			/* If in a given coordinates is placed an opponent piece, then add it to possible moves and break since we can't go further on this diagonal */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() !== $this->getSide())
			{
				$possibleMoves[] = $checkedCoordination;
				break;
			}

			if ($pieceOnSquare == null)
			{
				$possibleMoves[] = $checkedCoordination;
			}

			/* In this case we try to hit our own piece, so we can't go this way or any further on this diagonal, and it means we are protecting that piece */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $this->getSide()) {
				$protectedSquares[] = $checkedCoordination;
				break;
			}

			/* It will apply if we are on A8, C8, E8, G8, H7, H5, H3, H1 position then you can't go further up, because it is the end of a board */
			if ($horizontalSquareNumber == 8 or $this->cords[1] + $iteration == 8) break; 
		}

		/* [down, left] diagonal */
		for($horizontalSquareNumber = $this->cords[0] - 1, $iteration = 1; $horizontalSquareNumber >= 1; $horizontalSquareNumber--, $iteration++)
		{
			/* Going down left we will decrease our position on vertical column, and decrease on horizontal column */

			if (!$this->checkIfCoordinatesAreInsideOfBoard($horizontalSquareNumber, $this->cords[1] - $iteration)) break;

			/* These are coordination we check in current loop cycle if bishop can move there */
			$checkedCoordination = [$horizontalSquareNumber, $this->cords[1] - $iteration];
			$pieceOnSquare = $board[$horizontalSquareNumber][$this->cords[1] - $iteration]->getPiece();

			/* If in a given coordinates is placed an opponent piece, then add it to possible moves and break since we can't go further on this diagonal */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() !== $this->getSide())
			{
				$possibleMoves[] = $checkedCoordination;
				break;
			}

			if ($pieceOnSquare == null)
			{
				$possibleMoves[] = $checkedCoordination;
			}

			/* In this case we try to hit our own piece, so we can't go this way or any further on this diagonal, and it means we are protecting that piece */
			if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $this->getSide()) {
				$protectedSquares[] = $checkedCoordination;
				break;
			}

			/* It will apply if we are on B1, D1, F1, H1, A2, A4, A6, A8 position then you can't go further up, because it is the end of a board */
			if ($horizontalSquareNumber == 1 or $this->cords[1] - $iteration == 1) break; 
		}
		
		/* $protectedSquares on its own contains squares to which we can move and those we aim on which are either ours or our oponnent pieces, $possibleMoves contains all of the other moves like empty squares or oponnent pieces*/
		return ['possible_moves' => $possibleMoves, 'protected_squares' => array_merge($possibleMoves, $protectedSquares)];
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