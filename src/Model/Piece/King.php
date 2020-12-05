<?php

namespace App\Model\Piece;

use App\Model\Game;

class King extends Piece
{
	private string $id;

	private string $name = 'king';

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

		/* King can move in every direction but only one square at a time, we also must check if the king won't be in check in a given square */

		/*
			$cords[0] is horizontal column
			$cords[1] is vertical column
		*/

		$potentialMovesCoordinates = $this->getPotentialCordsToWhichKingCanMoveBasedOnCurrentPosition($this->cords);

		foreach ($potentialMovesCoordinates as $potentialMove) {
			if ($this->checkIfKingCanMoveToGivenSquare($game, $potentialMove)) {
				$possibleMoves[] = $potentialMove;
			}
		}

		/* Now we must figure out which squares king protects, and those are all to which king can move unless that square is attacked by oponnent's piece then king does not protect it since it would be in check */
		$protectedSquaresByOpponent = $this->getSquaresWhichOpponentsPiecesProtect($game, $this->getSide());

		foreach ($potentialMovesCoordinates as $potentialMove) {
			if (!$this->checkIfCoordinatesAreInsideOfBoard($potentialMove[0], $potentialMove[1])) continue;

			if (!in_array($potentialMove, $protectedSquaresByOpponent)) {
				$protectedSquares[] = $potentialMove;
			}
		}

		
		return ['possible_moves' => $possibleMoves, 'protected_squares' => $protectedSquares];
	}

	private function checkIfKingCanMoveToGivenSquare(Game $game, array $cords): bool 
	{
		if (!$this->checkIfCoordinatesAreInsideOfBoard($cords[0], $cords[1])) return false;

		$board = $game->getBoard();

		$pieceOnSquare = $board[$cords[0]][$cords[1]]->getPiece();

		/* If on this square is placed our piece then we can't move there */
		if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $this->getSide())
		{
			return false;
		}

        if ($this->checkIfKingIsInCheck($game, $cords)) {
			return false;
		}
		
		return true;
	}

	public function checkIfKingIsInCheck(Game $game, $kingCordsOnBoard = null): bool
	{
		$board = $game->getBoard();

		/* That function can be used from outside this class in situation which we check coordinates in which king is currently placed not the coordinates to which we want to move */
		/* So it can check square which already has a king or a square to which king wants to move */
		if (is_null($kingCordsOnBoard)) $kingCordsOnBoard = $this->cords;

		/* We must check if: 
			1.Rook is aligned with a square,
			2.Queen is aligned with a square or is in the same diagonal,
			3.Bishop is in the same diagonal as square,
			4.Knight is attacking that square,
			5.Pawn is attacking that square, 
			6.Opponent king is attacking that square
		*/

		/* Our flag */
		$isInCheck = false;

		$opponentKingPositionOnBoard = [];

		$opponentProtectedSquaresCoords = array();
	
		/* I could go through all of the opponent pieces and check if any of them has that square in possible moves, and if on that square is placed an opponent's piece check if that piece is protected */
		foreach ($board as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
				$piece = $square->getPiece();

				/* If there is as piece on that square */
				if (is_object($piece) && $piece->getSide() !== $this->getSide()) {
					
					/* Check if this is the king, if it is this king then there is no point in checking and also it would cause infinite loop */
					/* If it is the other king there is still no point in checking because that king could never move to any square bordering with this king according to the rules of the game so it would not be in possibleMoves, and also it would cause infinite loop*/
                    if ($piece instanceof $this) {

						if ($piece->getSide() !== $this->getSide()) $opponentKingPositionOnBoard = $piece->getCords();
                        continue;
					}

					$opponentProtectedSquaresCoords = array_merge($piece->getProtectedSquares($game), $opponentProtectedSquaresCoords);
				}
			}
		}	
	
		/* If king is or wants to move to a square which is protected(or in another word attacked) by oponnent then it is in check on that square */
		/* If it comes to possible moves they don't fit, cause for instance pawn can move one square up but he does not protect that square */
		if (in_array($kingCordsOnBoard, $opponentProtectedSquaresCoords)) 
		{
			$isInCheck = true;
		}

		/* If the examined square has an opponent's piece then we have to check if it is not protected and we can capture */
		$squareOnBoardToWhichKingIsMoving = $board[$kingCordsOnBoard[0]][$kingCordsOnBoard[1]]->getPiece();

		if(is_object($squareOnBoardToWhichKingIsMoving) && $squareOnBoardToWhichKingIsMoving->getSide() !== $this->getSide()) {

			if (in_array($kingCordsOnBoard, $opponentProtectedSquaresCoords)) {

				$isInCheck = true;
			}
		}

		/* Check if opponent's king is bordering with given square, I omit kings in previous loop to avoid infinite loop */
		$cordsOnWhichOpponentKingCannnotBe = $this->getPotentialCordsToWhichKingCanMoveBasedOnCurrentPosition($kingCordsOnBoard);

		if (in_array($opponentKingPositionOnBoard, $cordsOnWhichOpponentKingCannnotBe)) 
		{
			$isInCheck = true;
		}
		
		return $isInCheck;
	}

	public function getPotentialCordsToWhichKingCanMoveBasedOnCurrentPosition($kingCordsOnBoard): array
	{
		return [
			[$kingCordsOnBoard[0], $kingCordsOnBoard[1] - 1], /* Left */
			[$kingCordsOnBoard[0] + 1, $kingCordsOnBoard[1] - 1], /* Left and up on diagonal */
			[$kingCordsOnBoard[0] - 1, $kingCordsOnBoard[1] - 1], /* Down and left on diagonal */
			[$kingCordsOnBoard[0] - 1, $kingCordsOnBoard[1]], /* Down */
			[$kingCordsOnBoard[0] - 1, $kingCordsOnBoard[1] + 1], /* Down and right on diagonal */
			[$kingCordsOnBoard[0], $kingCordsOnBoard[1] + 1], /* Right */
			[$kingCordsOnBoard[0] + 1, $kingCordsOnBoard[1] + 1], /* Right and up on diagonal */
			[$kingCordsOnBoard[0] + 1, $kingCordsOnBoard[1]] /* Up */
		];
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