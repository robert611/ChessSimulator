<?php 

namespace App\Model\PositionEvaluation;

use App\Model\Game;
use App\Model\Piece\Pawn;

class EvaluateDoubledPawns implements EvaluationInterface
{
    use SortPawns;

    private Game $game;

    public function __construct(Game $game)
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

        /** @var Pawn[] $pawns */
        $pawns = $this->sortPawnsByVerticalColumn($pawns);

        $lastPawnVerticalColumn = null;

        foreach ($pawns as $pawn)
        {
            $currentPawnVerticalColumn = $pawn->getCords()[1];

            if ($lastPawnVerticalColumn == null) {
                $lastPawnVerticalColumn = $currentPawnVerticalColumn;
                continue;
            }
            
            if ($lastPawnVerticalColumn == $currentPawnVerticalColumn) {
                $numberOfDoubledPawns++;
            }

            $lastPawnVerticalColumn = $currentPawnVerticalColumn;
        }

        return $numberOfDoubledPawns;
    }
}
