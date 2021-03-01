<?php 

namespace App\Tests\Model\PositionEvaluation;

use App\Model\Game;
use PHPUnit\Framework\TestCase;
use App\Model\PositionEvaluation\EvaluatePawnGroups;

class SortPawnsTest extends TestCase
{
    public function testSortPawnsByVerticalColumn()
    {
        $game = new Game();

        $game->getBoard()[2][3]->setPiece(null);

        $pawns = $game->getSideSpecificPiecesByName('white', 'pawn');

        $evaluatePawnGroups = new EvaluatePawnGroups($game);
        
        shuffle($pawns);

        $sortedPawns = $evaluatePawnGroups->sortPawnsByVerticalColumn($pawns);

        foreach ($sortedPawns as $key => $pawn)
        {
            if ($key == 0) continue;

            $previousPawnVerticalColumn = $sortedPawns[$key - 1]->getCords()[1];

            $this->assertTrue($pawn->getCords()[1] > $previousPawnVerticalColumn);
        }
    }
}