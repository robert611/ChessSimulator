<?php 

namespace App\Model\PositionEvaluation;

use App\Model\PositionEvaluation\EvaluationInterface;

class EvaluatePawnGroups implements EvaluationInterface
{
    private \App\Model\Game $game;

    public function __construct(\App\Model\Game $game)
    {
        $this->game = $game;
    }

    public function getEvaluation(): float
    {
        $evaluation = 0.00;

        $advantageGivenByOnePawnGroupLessWithTheSameNumberOfPawns = 0.20;
        $advantageGivenByOnePawnGroupLessWithDiffrentNumberOfPawns = 0.10;

        $advantageToUseInThisCase = null;

        $whitePawnsCount = count($this->game->getSideSpecificPiecesByName('white', 'pawn'));
        $blackPawnsCount = count($this->game->getSideSpecificPiecesByName('black', 'pawn'));

        $whitePawnGroupsCount = $this->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $this->getPawnGroupsCount('black');

        $diffrence = $whitePawnGroupsCount - $blackPawnGroupsCount;

        $diffrence < 0 ? $diffrence = - $diffrence : null;

        $whitePawnsCount == $blackPawnsCount ? $advantageToUseInThisCase = $advantageGivenByOnePawnGroupLessWithTheSameNumberOfPawns 
            : $advantageToUseInThisCase = $advantageGivenByOnePawnGroupLessWithDiffrentNumberOfPawns; 
        
        /* If one side has no pawns at all then having one pawn group more is not a disadvantage */
        if (($whitePawnGroupsCount < $blackPawnGroupsCount) && ($whitePawnsCount !== 0 or $diffrence > 1))
        {
            $whitePawnsCount == 0 ? $diffrence -= 1 : null;
            $evaluation += $diffrence * $advantageToUseInThisCase;
        }
        else if (($whitePawnGroupsCount > $blackPawnGroupsCount) && ($blackPawnsCount !== 0 or $diffrence > 1))
        { 
            $blackPawnsCount == 0 ? $diffrence -= 1 : null;
            $evaluation -= $diffrence * $advantageToUseInThisCase;
        }

        return $evaluation;
    }

    public function getPawnGroupsCount(string $side): int
    {
        $pawnGroupsCount = 0;

        $pawns = $this->game->getSideSpecificPiecesByName($side, 'pawn');

        $pawns = $this->sortPawnsByVerticalColumn($pawns);

        $lastPawnVerticalColumn = null;

        count($pawns) > 0 ? $pawnGroupsCount++ : null;

        foreach ($pawns as $pawn)
        {
            $currentPawnVerticalColumn = $pawn->getCords()[1];

            if ($lastPawnVerticalColumn == null) {
                $lastPawnVerticalColumn = $currentPawnVerticalColumn;
                continue;
            }
            
            if ($lastPawnVerticalColumn <= $currentPawnVerticalColumn - 2) $pawnGroupsCount++;

            $lastPawnVerticalColumn = $currentPawnVerticalColumn;
        }

        return $pawnGroupsCount;
    }

    public function sortPawnsByVerticalColumn(?array $pawns): ?array
    {
        usort($pawns, function($a, $b) {
            return ($a->getCords()[1] < $b->getCords()[1]) ? -1 : 1;
        });

        return $pawns;
    }
}