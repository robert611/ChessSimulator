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

        $advanatageToUseInThisCase = null;

        $whitePawnsCount = count($this->game->getSideSpecificPiecesByName('white', 'pawn'));
        $blackPawnsCount = count($this->game->getSideSpecificPiecesByName('black', 'pawn'));

        $whitePawnGroupsCount = $this->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $this->getPawnGroupsCount('black');

        $diffrence = $whitePawnGroupsCount - $blackPawnGroupsCount;

        $diffrence < 0 ? $diffrence = - $diffrence : null;

        $whitePawnsCount == $blackPawnsCount ? $advanatageToUseInThisCase = $advantageGivenByOnePawnGroupLessWithTheSameNumberOfPawns 
            : $advanatageToUseInThisCase = $advantageGivenByOnePawnGroupLessWithDiffrentNumberOfPawns; 
        
        if ($whitePawnGroupsCount < $blackPawnGroupsCount)
        {
            $evaluation += $diffrence * $advanatageToUseInThisCase;
        }
        else if ($whitePawnGroupsCount > $blackPawnGroupsCount)
        {
            $evaluation -= $diffrence * $advanatageToUseInThisCase;
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
            $pawnVerticalColumn = $pawn->getCords()[1];

            if ($lastPawnVerticalColumn == null) {
                $lastPawnVerticalColumn = $pawnVerticalColumn;
                continue;
            }
            
            if ($pawnVerticalColumn !== $lastPawnVerticalColumn + 1) $pawnGroupsCount++;

            $lastPawnVerticalColumn = $pawnVerticalColumn;
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