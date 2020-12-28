<?php

namespace App\Model\Piece;

class Pawn extends Piece
{
	private string $id;

	private string $name = 'pawn';

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
		$gameMoves = $game->getMoves();
		$board = $game->getBoard();

		$possibleMoves = [];

		if ($this->side == "white") {
			$pawnStartingLine = 2;
			$moveOneSquareUpCords = [$this->cords[0] + 1, $this->cords[1]];	
			$moveTwoSquaresUpCords = [$this->cords[0] + 2, $this->cords[1]];	
			$moveUpAndLeftCords = [$this->cords[0] + 1, $this->cords[1] - 1];	
			$moveUpAndRightCords = [$this->cords[0] + 1, $this->cords[1] + 1];	
		} else {
			$pawnStartingLine = 7;
			$moveOneSquareUpCords = [$this->cords[0] - 1, $this->cords[1]];	
			$moveTwoSquaresUpCords = [$this->cords[0] - 2, $this->cords[1]];
			$moveUpAndLeftCords = [$this->cords[0] - 1, $this->cords[1] + 1];	
			$moveUpAndRightCords = [$this->cords[0] - 1, $this->cords[1] - 1];
		}

		/* Possible moves for pawn will be: */
		/* 
		* One square up
		* Two squares up if it is first move of the pawn
		* Move up and left if on that square is placed oponnent piece
		* Move up and right if on that square is placed opponent piece
		* En pasant, which is move up and left or move up and right even if there is not any opponent piece on that square, but opponent pawn moved 2 squares up and now is on the same horizontall column next to our pawn, en pasant also captures that opponent pawn
		* Also We must check if that pawn is not blocking any attack from opponent's piece towards our king, but it will be done in diffrent method called getPossibleMoves
		/

		/* One move up */
		if ($this->checkIfCoordinatesAreInsideOfBoard($moveOneSquareUpCords[0], $moveOneSquareUpCords[1]))
		{
			$moveOneSquareUpOnBoard = $board[$moveOneSquareUpCords[0]][$moveOneSquareUpCords[1]]->getPiece();

            /* If on that square is a piece either ours or our opponent's then pawn can't move there */
            if (!is_object($moveOneSquareUpOnBoard)) {
                $possibleMoves[] = $moveOneSquareUpCords;
            }
        }
		
		/* Two moves up */
		if ($this->checkIfCoordinatesAreInsideOfBoard($moveTwoSquaresUpCords[0], $moveTwoSquaresUpCords[1]))
	 	{
            $moveTwoSquaresUpOnBoard = $board[$moveTwoSquaresUpCords[0]][$moveTwoSquaresUpCords[1]]->getPiece();

            /* If on that square is a piece either ours or our opponent's then pawn can't move there, also it must be the first move of that pawn to be able to move two squares at the same time, if the white pawn is on second and black pawn on seventh line then it is first move */
			/* Also we must check if there is some piece on a square up then we can't jump through it */
            if (!is_object($moveOneSquareUpOnBoard) && !is_object($moveTwoSquaresUpOnBoard) && $pawnStartingLine == $this->cords[0]) {
                $possibleMoves[] = $moveTwoSquaresUpCords;
            }
        }

		/* Move up and left with capture */
        if ($this->checkIfCoordinatesAreInsideOfBoard($moveUpAndLeftCords[0], $moveUpAndLeftCords[1])) {
            $moveUpAndLeftOnBoard = $board[$moveUpAndLeftCords[0]][$moveUpAndLeftCords[1]]->getPiece();
        
            /* In order to capture up and left there must be an opponent's piece on that square */
            if (is_object($moveUpAndLeftOnBoard) && $moveUpAndLeftOnBoard->getSide() !== $this->getSide()) {
                $possibleMoves[] = $moveUpAndLeftCords;
            }
        }

		/* Move up and right with capture */
		if ($this->checkIfCoordinatesAreInsideOfBoard($moveUpAndRightCords[0], $moveUpAndRightCords[1])) {
			$moveUpAndRightOnBoard = $board[$moveUpAndRightCords[0]][$moveUpAndRightCords[1]]->getPiece();

			/* In order to capture up and left there must be an opponent's piece on that square */
			if(is_object($moveUpAndRightOnBoard) && $moveUpAndRightOnBoard->getSide() !== $this->getSide()) {
				$possibleMoves[] = $moveUpAndRightCords;
			}
		}
		
		/* En passant up and left and up and right */
		/* En passant is possible only if last move of our opponent was with his pawn two squares at a time, and that moved pawn is vertically next to this pawn and is horizontally on the same file as this pawn either on left or right side */
		$lastOpponentMove = !empty($gameMoves) ? $gameMoves[count($gameMoves) - 1] : ['piece' => null, 'previous_cords' => [], 'new_cords_square' => []];
		
		/* Check if it was a move with a pawn */
		if ($lastOpponentMove['piece'] instanceof \App\Model\Piece\Pawn) {
			$movesAtATime = $lastOpponentMove['previous_cords'][0] - $lastOpponentMove['new_cords_square']->getCords()[0];

			/* Check if it was two squares at a time */
			/* It will be 2 if it is black pawn and minus 2 if it is white pawn */
			if($movesAtATime == 2 or $movesAtATime == -2) {

				if ($this->side == "white") {
					$lastOpponentMoveProperLeftVerticalPosition = $lastOpponentMove['new_cords_square']->getCords()[1] + 1;
					$lastOpponentMoveProperRightVerticalPosition = $lastOpponentMove['new_cords_square']->getCords()[1] - 1;
				} else {
					$lastOpponentMoveProperLeftVerticalPosition = $lastOpponentMove['new_cords_square']->getCords()[1] - 1;
					$lastOpponentMoveProperRightVerticalPosition = $lastOpponentMove['new_cords_square']->getCords()[1] + 1;
				}

				/* Check if the pawn is on the same file horizontally and next to the pawn on left side vertically */
				if ($lastOpponentMove['new_cords_square']->getCords()[0] == $this->cords[0] && $lastOpponentMoveProperLeftVerticalPosition == $this->cords[1]) {
					/* Remember in en passant move we do not capture oponnent pawn in a square which has that pawn but on a square up vertically */
					$possibleMoves[] = $moveUpAndLeftCords;
				}

				/* Check if the pawn is on the same file horizontally and next to the pawn on right side vertically */
				if ($lastOpponentMove['new_cords_square']->getCords()[0] == $this->cords[0] && $lastOpponentMoveProperRightVerticalPosition == $this->cords[1]) {
					/* Remember in en passant move we do not capture oponnent pawn in a square which has that pawn but on a square up vertically */
					$possibleMoves[] = $moveUpAndRightCords;
				}
			}
		}

		/* In case of a pawn protected squares are not all of the pawn moves, since pawn does not protect square up or two square up but he can move there */
		$protectedSquares = [$moveUpAndLeftCords, $moveUpAndRightCords];

		/* $protectedSquares on its own contains squares to which we can move and those we aim on which are either ours or our oponnent pieces, $possibleMoves contains all of the other moves like empty squares or oponnent pieces */
		return ['possible_moves' => $possibleMoves, 'protected_squares' => $protectedSquares];
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