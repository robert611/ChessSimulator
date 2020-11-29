<?php

namespace App\Model\Piece;

class King extends Piece
{
	private string $name = 'king';
	private string $picture;
	private array $cords;
	private string $side;

	public function __construct($cords, $side)
	{
		$this->cords = $cords;
		$this->side = $side;
	}

	public function move(array $board) 
	{
		$possibleMoves = $this->getPossibleMoves($board);

		return $possibleMoves;
	}

	public function getPossibleMoves(array $board): array
	{
		/* First lets calculate all moves which that piece can make */
		$possibleMoves = [];

		/* King can move in every direction but only one square at a time, we also must check if the king won't be in check in a given square */

		/*
			$cords[0] is horizontal column
			$cords[1] is vertical column
		*/

		/* Up */
		$coordinates = [$this->cords[0], $this->cords[1] + 1];

		if($this->checkIfKingCanMoveToGivenSquare($board, $coordinates)) {
			$possibleMoves[] = $coordinates;
		}

		return $possibleMoves;
	}

	private function checkIfKingCanMoveToGivenSquare(array $board, array $cords): bool 
	{
		$squareOnBoard = $board[$cords[0]][$cords[1]];

		/* If on this square is placed our piece then we can't move there */
		if (is_object($squareOnBoard) && $squareOnBoard->getSide() == $this->getSide())
		{
			return false;
		}

        if ($this->checkIfKingIsInCheck($board)) {
			return false;
        }
		
		return true;
	}

	public function checkIfKingIsInCheck(array $board, $kingCordsOnBoard = null): bool
	{
		/* That function can be used from outside this class in situation which we check coordinates in which king is currently placed not the coordinates to which we want to move */
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

		$oponnentPossibleMoves = array();
	
		/* I could go through all of the opoonent pieces and check if any of them has that square in possible moves */
		foreach ($board as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
				/* If there is as piece on that square */
				if (is_object($square)) {
					
					/* Check if this is the king, if it is this king then there is no point in checking and also it would cause infinite loop */
					/* If it is the other king there is still no point in checking because that king could never move to any square bordering with this king according to the rules of the game so it would not be in possibleMoves, and also it would cause infinite loop*/
                    if ($square instanceof $this) {

						if ($square->getSide() !== $this->getSide()) $opponentKingPositionOnBoard = $square->getCords();
                        continue;
					}

					$oponnentPossibleMoves = array_merge($square->getPossibleMoves($board), $oponnentPossibleMoves);
				}
			}
		}	
	
		if (in_array($kingCordsOnBoard, $oponnentPossibleMoves)) 
		{
			$isInCheck = true;
		}

		/* Check if opponent's king is bordering with given square */
		$cordsOnWhichOpponentKingCannnotBe = [
			[$kingCordsOnBoard[0], $kingCordsOnBoard[1] - 1], /* Left */
			[$kingCordsOnBoard[0] + 1, $kingCordsOnBoard[1] - 1], /* Left and up on diagonal */
			[$kingCordsOnBoard[0] - 1, $kingCordsOnBoard[1] - 1], /* Down and left on diagonal */
			[$kingCordsOnBoard[0] - 1, $kingCordsOnBoard[1]], /* Down */
			[$kingCordsOnBoard[0] - 1, $kingCordsOnBoard[1] + 1], /* Down and right on diagonal */
			[$kingCordsOnBoard[0], $kingCordsOnBoard[1] + 1], /* Right */
			[$kingCordsOnBoard[0] + 1, $kingCordsOnBoard[1] + 1], /* Right and up on diagonal */
			[$kingCordsOnBoard[0] + 1, $kingCordsOnBoard[1]] /* Up */
		];

		if (in_array($opponentKingPositionOnBoard, $cordsOnWhichOpponentKingCannnotBe)) 
		{
			$isInCheck = true;
		}
		
		return $isInCheck;
	}

	public function isProtectingGivenSquare(array $board, array $squareToProtect): bool
	{
		return true;
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