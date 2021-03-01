<?php 

namespace App\Model\PositionEvaluation;

use App\Model\PositionEvaluation\EvaluationInterface;
use App\Model\PositionEvaluation\SortPawns;

class EvaluateDoubledPawns implements EvaluationInterface
{
    use SortPawns;

    private \App\Model\Game $game;

    public function __construct(\App\Model\Game $game)
    {
        $this->game = $game;
    }

    public function getEvaluation(): float
    {
        $evaluation = 0.00;

        $advantageGivenByHavingOneDoubledPawnLess = 0.2;

        $whiteDoubledPawnsNumber = $this->getNumberOfDoubledPawns('white');
        $blackDoubledPawnsNumber = $this->getNumberOfDoubledPawns('black');

        $diffrence = $whiteDoubledPawnsNumber - $blackDoubledPawnsNumber;

        $diffrence < 0 ? $diffrence = - $diffrence : null;

        if ($whiteDoubledPawnsNumber < $blackDoubledPawnsNumber)
        {
            $evaluation += $diffrence * $advantageGivenByHavingOneDoubledPawnLess;
        }
        else if ($whiteDoubledPawnsNumber > $blackDoubledPawnsNumber)
        { 
            $evaluation -= $diffrence * $advantageGivenByHavingOneDoubledPawnLess;
        }

        return $evaluation;
    }

    public function getNumberOfDoubledPawns(string $side): int
    {
        $numberOfDoubledPawns = 0;

        $pawns = $this->game->getSideSpecificPiecesByName($side, 'pawn');

        $pawns = $this->sortPawnsByVerticalColumn($pawns);

        $lastPawnVerticalColumn = null;

        foreach ($pawns as $pawn)
        {
            $currentPawnVerticalColumn = $pawn->getCords()[1];

            if ($lastPawnVerticalColumn == null) {
                $lastPawnVerticalColumn = $currentPawnVerticalColumn;
                continue;
            }
            
            if ($lastPawnVerticalColumn == $currentPawnVerticalColumn) $numberOfDoubledPawns++;

            $lastPawnVerticalColumn = $currentPawnVerticalColumn;
        }

        return $numberOfDoubledPawns;
    }
}
