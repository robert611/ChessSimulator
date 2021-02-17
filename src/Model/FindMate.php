<?php 

namespace App\Model;

use App\Model\Game;

class FindMate
{
    private Game $game;

    private $sideToCheckmate;

    public function __construct(Game $game)
    {
        $this->game = $game;
        $this->sideToChecmkate = $this->game->getOpponentSide($this->game->getSideToMove());
    }

    public function findMate(int $depth): ?array
    {
        $matingPatterns = array();

        $side = $this->game->getSideToMove();

        $matingPatterns[] = $this->traverseThroughGivenMoveSequence($this->game, $side, $depth);

        return $matingPatterns;
    }

    public function traverseThroughGivenMoveSequence($game, $side, $depth, $iteration = 1, $matingMoves = []): ?array
    {
        $matingPatternsLeadingFromSomeMove = array();

        if ($iteration > ($depth * 2)) {
            return null;
        }

        $opponentSide = $game->getOpponentSide($side);

        $pieces = $game->getGivenSidePieces($side);

        foreach ($pieces as $piece) 
        {
            $possibleMoves = $piece->getPossibleMoves($game);

            foreach ($possibleMoves as $move)
            { 
                $recreatedBoard = (new \App\Model\Board)->recreateBoard($game->getBoard());

                $gameWithNewMove = clone $game;
                $gameWithNewMove->setBoard($recreatedBoard);

                $gameWithNewMove->makeMove($gameWithNewMove->getBoard()[$piece->getCords()[0]][$piece->getCords()[1]]->getPiece(), $move);

                $opponentKing = $gameWithNewMove->getPieceSquare('king', $opponentSide)->getPiece();

                $matingMovesWithThisVariation = array_merge($matingMoves, [['from' => [$piece->getCords()[0], $piece->getCords()[1]], 'to' => $move]]);

                if ($opponentKing->checkIfKingIsInCheckmate($gameWithNewMove) == true)
                {
                    /* Do not add sequence of moves which lead to mate against us */
                    if ($this->sideToCheckmate !== $opponentSide)
                    {
                        $matingPatternsLeadingFromSomeMove[] = $matingMovesWithThisVariation;
                    }
                    continue;
                }

                if ($gameWithNewMove->checkIfGameHasEnded()) {
                    continue;
                }
            
                $sequenceIteration = $iteration + 1;
                $deeperMatingPatternsLeadingFromSomeMove = $this->traverseThroughGivenMoveSequence($gameWithNewMove, $opponentSide, $depth, $sequenceIteration, $matingMovesWithThisVariation);

                if (!is_null($deeperMatingPatternsLeadingFromSomeMove))
                    $matingPatternsLeadingFromSomeMove = array_merge($matingPatternsLeadingFromSomeMove, $deeperMatingPatternsLeadingFromSomeMove);
            }
        }

        return $matingPatternsLeadingFromSomeMove;
    }
}