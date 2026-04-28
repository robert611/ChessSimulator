<?php 

namespace App\Model\PositionEvaluation;

use App\Model\Game;
use App\Model\Piece\Pawn;

class EvaluatePassedPawns implements EvaluationInterface
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

        $advantageGivenByPassedPawn = 0.25;
        $advantageGivenByDoubledPassedPawn = 0.08;

        $whitePassedPawns = $this->getPassedPawns('white');
        $blackPassedPawns = $this->getPassedPawns('black');

        $whiteDoubledPassedPawnsNumber = $this->getDoubledPassedPawnsNumber($whitePassedPawns);
        $blackDoubledPassedPawnsNumber = $this->getDoubledPassedPawnsNumber($blackPassedPawns);

        $whiteNotDoubledPassedPawnsNumber = count($whitePassedPawns) - $whiteDoubledPassedPawnsNumber;
        $blackNotDoubledPassedPawnsNumber = count($blackPassedPawns) - $blackDoubledPassedPawnsNumber;

        $evaluation += ($whiteNotDoubledPassedPawnsNumber * $advantageGivenByPassedPawn) + ($whiteDoubledPassedPawnsNumber * $advantageGivenByDoubledPassedPawn);
        $evaluation -= ($blackNotDoubledPassedPawnsNumber * $advantageGivenByPassedPawn) + ($blackDoubledPassedPawnsNumber * $advantageGivenByDoubledPassedPawn);

        return $evaluation;
    }

    /**
     * @return Pawn[]
     */
    public function getPassedPawns(string $side): array
    {
        $passedPawns = array();

        /** @var Pawn[] $myPawns */
        $myPawns = $this->game->getSideSpecificPiecesByName($side, 'pawn');
        /** @var Pawn[] $opponentPawns */
        $opponentPawns = $this->game->getSideSpecificPiecesByName($this->game->getOpponentSide($side), 'pawn');

        $mapOfOpponentPawnsOnVerticalColumn = $this->getPawnsOnVerticalColumnsMap($opponentPawns);

        foreach ($myPawns as $pawn) {
            $currentPawnVerticalColumn = $pawn->getCords()[1];

            $previousColumn = $currentPawnVerticalColumn - 1;
            $nextColumn = $currentPawnVerticalColumn + 1;

            if ($currentPawnVerticalColumn === 1) {
                $previousColumn = 1;
            }
            if ($currentPawnVerticalColumn === 8) {
                $nextColumn = 8;
            }

            $isPassedPawn = true;

            foreach ([$previousColumn, $currentPawnVerticalColumn, $nextColumn] as $column)
            {
                if ($mapOfOpponentPawnsOnVerticalColumn[$column] > 0) {
                    $isPassedPawn = false;
                }
            }

            if ($isPassedPawn) {
                $passedPawns[] = $pawn;
            }
        }

        return $passedPawns;
    }

    public function getPawnsOnVerticalColumnsMap(?array $pawns): array
    {
        $map = array_fill(1, 8, 0);

        foreach ($pawns as $pawn)
        {
            $currentPawnVerticalColumn = $pawn->getCords()[1];

            $map[$currentPawnVerticalColumn]++;
        }

        return $map;
    }

    /**
     * @param Pawn[] $passedPawns
     */
    public function getDoubledPassedPawnsNumber(array $passedPawns): int
    {
        $doubledPassedPawns = 0;
        $columnsOfPassedPawns = array_fill(1, 8, 0);

        foreach ($passedPawns as $pawn) {
            if ($pawn->isPawnDoubled($this->game)) {
                $doubledPassedPawns++;
            }

            $columnsOfPassedPawns[$pawn->getCords()[1]]++;
        }

        /* If there are two or more doubled pawns on the same column, than treat one as a normal pawn */
        foreach ($columnsOfPassedPawns as $column) {
            if ($column > 1) {
                $doubledPassedPawns -= 1;
            }
        }

        return $doubledPassedPawns;
    }
}