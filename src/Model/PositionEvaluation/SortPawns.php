<?php 

namespace App\Model\PositionEvaluation;

trait SortPawns 
{
    public function sortPawnsByVerticalColumn(?array $pawns): ?array
    {
        usort($pawns, function($a, $b) {
            return ($a->getCords()[1] < $b->getCords()[1]) ? -1 : 1;
        });

        return $pawns;
    }
}