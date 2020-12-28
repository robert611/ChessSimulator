<?php 

namespace App\Model\Piece;

use App\Model\Game;
use App\Model\Piece\Piece;
use App\Model\BoardSquare;

abstract class Piece 
{
    private string $id;
    
    private string $name;

    private string $picture;
    
    private array $cords;
    
    private string $side;
    
    abstract function move(Game $game);

    public function getPotentialPossibleMovesWithoutCheckingIfTheyLeaveKingInCheck($game)
    {
		return $this->findOutPossibleMovesAndProtectedSquares($game)['possible_moves'];
    }

    public function getPossibleMoves(Game $game): array
	{
        $possibleMoves = $this->findOutPossibleMovesAndProtectedSquares($game)['possible_moves'];
        
        return $this->checkIfPossibleMovesLeaveKingInCheckAndFilterThem($possibleMoves, $game);
	}

	public function getProtectedSquares(Game $game): array
	{
		return $this->findOutPossibleMovesAndProtectedSquares($game)['protected_squares'];
    }
    
    public function checkIfPossibleMovesLeaveKingInCheckAndFilterThem(array $possibleMoves, Game $game): array
	{
        $filteredMoves = array();

        $opponentKingColor = $this->getSide() == 'white' ? 'black' : 'white';
        $opponentKing = $game->getPieceSquare('king', $opponentKingColor)->getPiece();
        
        /* In this case that method is called from king method checkIfKingIsInCheckmate to find out king attacking pieces, we do not want to actually capture oponnent's king in loop below */
        if ($opponentKing->checkIfKingIsInCheck($game, $opponentKing->getCords())) {
            return $possibleMoves;
        }
        
		/* Check if any of possible moves is truly not possible because pawn is blocking an attack towards our king, and given move would put a king in position of check */
		foreach ($possibleMoves as $move) {
            $recreatedBoard = (new \App\Model\Board)->recreateBoard($game->getBoard());

            /* Make move and check if in that situation my king is in check */
			$gameWithPawnMove = clone $game;
            $gameWithPawnMove->setBoard($recreatedBoard);
			$gameWithPawnMove->makeMove($recreatedBoard[$this->getCords()[0]][$this->getCords()[1]]->getPiece(), $move);

            $myKing = $gameWithPawnMove->getPieceSquare('king', $this->getSide())->getPiece();

            $isInCheck = $myKing->checkIfKingIsInCheck($gameWithPawnMove, $myKing->getCords());

            if (!$isInCheck) $filteredMoves[] = $move;
		}

		return $filteredMoves;
    }
    
    public function checkIfGivenMoveLeavesKingInCheck(Game $game, Piece $piece, array $move): bool
    {
        $recreatedBoard = (new \App\Model\Board)->recreateBoard($game->getBoard());

        /* Make move and check if in that situation my king is in check */
        $gameWithNewMove = clone $game;
        $gameWithNewMove->setBoard($recreatedBoard);
        $gameWithNewMove->makeMove($piece, $move);

        $myKing = $gameWithNewMove->getPieceSquare('king', $piece->getSide())->getPiece();

        $isInCheck = $myKing->checkIfKingIsInCheck($gameWithNewMove, $myKing->getCords());

        return $isInCheck;
    }

    abstract function findOutPossibleMovesAndProtectedSquares(Game $game): array;

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
    
    public function getSquaresWhichGivenSidePiecesProtect(Game $game, string $side)
    {
        $board = $game->getBoard();

        $opponentProtectedSquaresCoords = array();

        foreach ($board as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
                $pieceOnSquare = $square->getPiece();

				/* If there is as piece on that square */
				if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() !== $side) {   
                    /* Without this if, it would lead to infinite loop beacause one king checks protected squares of another to calculate it's protected squares, so none can really do it */ 
                    if ($pieceOnSquare instanceof $this and $pieceOnSquare instanceof \App\Model\Piece\King) {
                        $opponentProtectedSquaresCoords = array_merge($pieceOnSquare->getPotentialCordsToWhichKingCanMoveBasedOnCurrentPosition($square->getCords()), $opponentProtectedSquaresCoords);
                        continue;
                    }

                    $opponentProtectedSquaresCoords = array_merge($pieceOnSquare->getProtectedSquares($game), $opponentProtectedSquaresCoords);
				}
			}
        }
        
        return $opponentProtectedSquaresCoords;
    }
}