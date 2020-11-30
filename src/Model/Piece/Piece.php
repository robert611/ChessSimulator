<?php 

namespace App\Model\Piece;

abstract class Piece 
{
    private string $name;

    private string $picture;
    
    private array $cord;
    
    private string $side;
    
    abstract function move(array $board);

    public function getPossibleMoves(array $board): array
	{
		return $this->findOutPossibleMovesAndProtectedSquares($board)['possible_moves'];
	}

	public function getProtectedSquares(array $board): array
	{
		return $this->findOutPossibleMovesAndProtectedSquares($board)['protected_squares'];
	}

    abstract function findOutPossibleMovesAndProtectedSquares(array $board): array;

    abstract function getPicture(): string;

    abstract function setPicture(string $picture): self;

    abstract function getSide(): string;

    abstract function setSide(string $side): self;

    abstract function getCords(): array;

    abstract function setCords(array $cords): self;

    abstract function getName(): string;

    abstract function setName(string $name): self;

    protected function checkIfCoordinatesAreInsideOfBoard($horizontal, $vertical): bool
	{
		if (($vertical > 8 or $horizontal > 8) or ($vertical < 1 or $horizontal < 1)) return false;
		
		return true;
    }

    public function isProtectingGivenSquare(array $board, array $squareToProtect): bool
	{
		$protectedSquares =  $this->findOutPossibleMovesAndProtectedSquares($board)['protected_squares'];

		if (in_array($squareToProtect, $protectedSquares)) {
			return true;
		}

		return false;
    }
    
    public function getSquaresWhichOpponentsPiecesProtect(array $board, $side)
    {
        $opponentProtectedSquaresCoords = array();

        foreach ($board as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
				/* If there is as piece on that square */
				if (is_object($square) && $square->getSide() !== $side) {   
                    /* Without this if, it would lead to infinite loop beacause one king checks protected squares of another to calculate it's protected squares, so none can really do it */ 
                    if ($square instanceof $this and $square instanceof \App\Model\Piece\King) {
                        $opponentProtectedSquaresCoords = array_merge($square->getPotentialCordsToWhichKingCanMoveBasedOnCurrentPosition($square->getCords()), $opponentProtectedSquaresCoords);
                        continue;
                    }

                    $opponentProtectedSquaresCoords = array_merge($square->getProtectedSquares($board), $opponentProtectedSquaresCoords);
				}
			}
        }
        
        return $opponentProtectedSquaresCoords;
    }
}