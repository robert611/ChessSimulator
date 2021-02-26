<?php 

namespace App\Model\PositionEvaluation;

use App\Model\PositionEvaluation\EvaluationInterface;

class EvaluateMaterial implements EvaluationInterface
{
    private \App\Model\Game $game;

    public function __construct(\App\Model\Game $game)
    {
        $this->game = $game;
    }

    public function getEvaluation(): float
    {
        $evaluation = 0.00;

        $advantageGivenByOneMaterialPoint = 0.5;

        $whiteMaterial = $this->getSideMaterialCount('white');
        $blackMaterial = $this->getSideMaterialCount('black');

        if ($whiteMaterial !== $blackMaterial)
        {
            $diffrenceInMaterial = $whiteMaterial - $blackMaterial;

            $diffrenceInMaterial < 0 ? $diffrenceInMaterial = - $diffrenceInMaterial : null;

            if ($whiteMaterial > $blackMaterial)
            {
                $evaluation += $diffrenceInMaterial * $advantageGivenByOneMaterialPoint;
            }
            else 
            {
                $evaluation -= $diffrenceInMaterial * $advantageGivenByOneMaterialPoint;
            }
        }

        return $evaluation;
    }

    public function getSideMaterialCount(string $side): float
    {
        $materialCount = 0;
        $piecesValues = ['pawn' => 1, 'king' => 3.5, 'bishop' => 3, 'knight' => 3, 'rook' => 5, 'quenn' => 9];

        $pieces = $this->game->getGivenSidePieces($side);

        foreach ($pieces as $piece)
        {
            $pieceName = strtolower($piece->getName());

            $materialCount += $piecesValues[$pieceName];
        }

        return $materialCount;
    }
}