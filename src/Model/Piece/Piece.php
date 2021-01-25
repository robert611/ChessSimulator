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
            /* It is a castle move, and it's already checked */
            if (isset($move[0]['from'])) {
                $filteredMoves[] = $move;
                continue;
            }

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
    
    public function checkIfGivenMoveSequenceLeavesKingInCheck(Game $game, Piece $piece, array $moves): bool
    {
        $recreatedBoard = (new \App\Model\Board)->recreateBoard($game->getBoard());

        /* Do not change state of piece which plays in actual game */
        $piece = clone $piece;

        /* Make move and check if in that situation my king is in check */
        $gameWithNewMoves = clone $game;
        $gameWithNewMoves->setBoard($recreatedBoard);

        foreach ($moves as $move) 
        {
            if (isset($move['from'])) 
            {
                $piece = $gameWithNewMoves->getBoard()[$move['from'][0]][$move['from'][1]]->getPiece();
                $move = $move['to'];
            }

            $gameWithNewMoves->makeMove($piece, $move);
        }

        $myKing = $gameWithNewMoves->getPieceSquare('king', $piece->getSide())->getPiece();

        $isInCheck = $myKing->checkIfKingIsInCheck($gameWithNewMoves, $myKing->getCords());

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
}