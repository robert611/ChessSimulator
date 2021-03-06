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

    public function testGetPawnGorupsCountWithDoubledPawns()
    {
        $tests = array();

        /* Situation 1 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);
        
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 3]);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 3, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 2, 'actual' => $blackPawnGroupsCount];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);
        
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 3]);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 4, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 2, 'actual' => $blackPawnGroupsCount];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);
        $game->getBoard()[7][7]->setPiece(null);
        
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 3]);

        $game->makeMove($game->getBoard()[2][7]->getPiece(), [3, 8]);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 4, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 3, 'actual' => $blackPawnGroupsCount];

        /* Situation 4 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);
        $game->getBoard()[7][7]->setPiece(null);
        
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 3]);

        $game->makeMove($game->getBoard()[2][7]->getPiece(), [3, 8]);

        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 6]);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 4, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 3, 'actual' => $blackPawnGroupsCount];

        /* Situation 5 */
        $game = new Game();

        $game->getBoard()[7][7]->setPiece(null);
        
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 2]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 6]);

        $evaluatePawnGroups = new EvaluatePawnGroups($game);

        $whitePawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('white');
        $blackPawnGroupsCount = $evaluatePawnGroups->getPawnGroupsCount('black');

        $tests[] = ['expected' => 1, 'actual' => $whitePawnGroupsCount];
        $tests[] = ['expected' => 3, 'actual' => $blackPawnGroupsCount];

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
}