<?php 

namespace App\Tests\Model\PositionEvaluation;

use App\Model\Game;
use PHPUnit\Framework\TestCase;
use App\Model\PositionEvaluation\EvaluatePawnGroups;

class EvaluatePawnGroupsTest extends TestCase
{
    public function testGetEvaluation()
    {
        $tests = array();

        /* Situation 1 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => 0, 'actual' => $evaluation];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $game->getBoard()[7][7]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => 0, 'actual' => $evaluation];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[2][1]->setPiece(null);
        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $game->getBoard()[7][4]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => -0.1, 'actual' => $evaluation];

        /* Situation 4 */
        $game = new Game();

        $game->getBoard()[2][1]->setPiece(null);
        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][5]->setPiece(null);
        $game->getBoard()[2][7]->setPiece(null);

        $game->getBoard()[7][4]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => -0.2, 'actual' => $evaluation];

        /* Situation 5 */
        $game = new Game();

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);
        $game->getBoard()[7][7]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => 0.2, 'actual' => $evaluation];

        foreach ($tests as $test)
        {
            $this->assertEquals($test['expected'], $test['actual']);
        }
    }

    public function testEvaluationWhenOneSideHasNoPawns()
    {
        $tests = array();

        /* Situation 1 */
        $game = new Game();

        $game->getBoard()[2][1]->setPiece(null);
        $game->getBoard()[2][2]->setPiece(null);
        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][4]->setPiece(null);
        $game->getBoard()[2][5]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][7]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => 0, 'actual' => $evaluation];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[2][1]->setPiece(null);
        $game->getBoard()[2][2]->setPiece(null);
        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][4]->setPiece(null);
        $game->getBoard()[2][5]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][7]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $game->getBoard()[7][5]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => 0.1, 'actual' => $evaluation];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[2][1]->setPiece(null);
        $game->getBoard()[2][2]->setPiece(null);
        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][4]->setPiece(null);
        $game->getBoard()[2][5]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][7]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $game->getBoard()[7][5]->setPiece(null);
        $game->getBoard()[7][7]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => 0.2, 'actual' => $evaluation];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][2]->setPiece(null);
        $game->getBoard()[7][3]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);
        $game->getBoard()[7][5]->setPiece(null);
        $game->getBoard()[7][6]->setPiece(null);
        $game->getBoard()[7][7]->setPiece(null);
        $game->getBoard()[7][8]->setPiece(null);

        $game->getBoard()[7][8]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $evaluation = $evaluatePawnGroups->getEvaluation();

        $tests[] = ['expected' => 0.0, 'actual' => $evaluation];

        foreach ($tests as $test)
        {
            $this->assertEquals($test['expected'], $test['actual']);
        }
    }

    public function testGetPawnGroupsCount()
    {
        $tests = array();

        /* Situation 1 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 2, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 2, 'actual' => $blackPawnGroupsCount];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $game->getBoard()[7][7]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 3, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 3, 'actual' => $blackPawnGroupsCount];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[2][2]->setPiece(null);
        $game->getBoard()[2][4]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 4, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 1, 'actual' => $blackPawnGroupsCount];

        /* Situation 4 */
        $game = new Game();

        $game->getBoard()[2][2]->setPiece(null);
        
        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][2]->setPiece(null);
        $game->getBoard()[7][3]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 2, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 1, 'actual' => $blackPawnGroupsCount];

        /* Situation 5 */
        $game = new Game();

        $game->getBoard()[2][1]->setPiece(null);
        $game->getBoard()[2][2]->setPiece(null);
        $game->getBoard()[2][3]->setPiece(null);
        $game->getBoard()[2][4]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[2][7]->setPiece(null);
        $game->getBoard()[2][8]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][2]->setPiece(null);
        $game->getBoard()[7][3]->setPiece(null);
        $game->getBoard()[7][6]->setPiece(null);
        $game->getBoard()[7][7]->setPiece(null);
        $game->getBoard()[7][8]->setPiece(null);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 1, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 1, 'actual' => $blackPawnGroupsCount];

        foreach ($tests as $test)
        {
            $this->assertEquals($test['expected'], $test['actual']);
        }
    }

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