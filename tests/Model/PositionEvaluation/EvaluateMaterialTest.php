<?php 

namespace App\Tests\Model;

use App\Model\Game;
use PHPUnit\Framework\TestCase;
use App\Model\PositionEvaluation\EvaluateMaterial;

class EvaluateMaterialTest extends TestCase
{
    public function testGetEvaluation()
    {
        $tests = array();

        /* Situation 1 */
        $game = new Game();

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][2]->setPiece(null);
        $game->getBoard()[8][1]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $evaluation = $evaluateMaterial->getEvaluation();

        $tests[] = ['expected' => 3.5, 'actual' => $evaluation];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[2][5]->setPiece(null);
        $game->getBoard()[2][6]->setPiece(null);
        $game->getBoard()[1][7]->setPiece(null);
        $game->getBoard()[8][1]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $evaluation = $evaluateMaterial->getEvaluation();

        $tests[] = ['expected' => 0.0, 'actual' => $evaluation];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[1][2]->setPiece(null);
        $game->getBoard()[1][3]->setPiece(null);
        $game->getBoard()[1][4]->setPiece(null);
        $game->getBoard()[7][7]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $evaluation = $evaluateMaterial->getEvaluation();

        $tests[] = ['expected' => -7, 'actual' => $evaluation];

        /* Situation 4 */
        $game = new Game();

        $game->getBoard()[1][2]->setPiece(null);
        $game->getBoard()[1][3]->setPiece(null);
        $game->getBoard()[1][4]->setPiece(null);
        $game->getBoard()[1][8]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $evaluation = $evaluateMaterial->getEvaluation();

        $tests[] = ['expected' => -10, 'actual' => $evaluation];

        /* Situation 5 */
        $game = new Game();

        $game->getBoard()[7][3]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $evaluation = $evaluateMaterial->getEvaluation();

        $tests[] = ['expected' => 0.5, 'actual' => $evaluation];

        foreach ($tests as $test)
        {
            $this->assertEquals($test['expected'], $test['actual']);
        }
    }

    public function testGetSideMaterialCount()
    {
        $tests = array();

        /* Situation 1 */
        $evaluateMaterial = new EvaluateMaterial(new Game());

        $whiteMaterial = $evaluateMaterial->getSideMaterialCount('white');
        $blackMaterial = $evaluateMaterial->getSideMaterialCount('black');

        $tests[] = ['expected' => 42.5, 'actual' => $whiteMaterial];
        $tests[] = ['expected' => 42.5, 'actual' => $blackMaterial];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[2][1]->setPiece(null);
        $game->getBoard()[2][2]->setPiece(null);
        $game->getBoard()[8][1]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $whiteMaterial = $evaluateMaterial->getSideMaterialCount('white');
        $blackMaterial = $evaluateMaterial->getSideMaterialCount('black');

        $tests[] = ['expected' => 40.5, 'actual' => $whiteMaterial];
        $tests[] = ['expected' => 37.5, 'actual' => $blackMaterial];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[1][4]->setPiece(null);
        $game->getBoard()[1][7]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $whiteMaterial = $evaluateMaterial->getSideMaterialCount('white');
        $blackMaterial = $evaluateMaterial->getSideMaterialCount('black');

        $tests[] = ['expected' => 30.5, 'actual' => $whiteMaterial];
        $tests[] = ['expected' => 42.5, 'actual' => $blackMaterial];

        /* Situation 4 */
        $game = new Game();

        $game->getBoard()[1][1]->setPiece(null);
        $game->getBoard()[1][4]->setPiece(null);
        $game->getBoard()[1][7]->setPiece(null);
        $game->getBoard()[1][8]->setPiece(null);

        $game->getBoard()[8][2]->setPiece(null);
        $game->getBoard()[7][2]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $whiteMaterial = $evaluateMaterial->getSideMaterialCount('white');
        $blackMaterial = $evaluateMaterial->getSideMaterialCount('black');

        $tests[] = ['expected' => 20.5, 'actual' => $whiteMaterial];
        $tests[] = ['expected' => 38.5, 'actual' => $blackMaterial];

        /* Situation 5 */
        $game = new Game();

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][2]->setPiece(null);
        $game->getBoard()[7][3]->setPiece(null);
        $game->getBoard()[8][8]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $whiteMaterial = $evaluateMaterial->getSideMaterialCount('white');
        $blackMaterial = $evaluateMaterial->getSideMaterialCount('black');

        $tests[] = ['expected' => 42.5, 'actual' => $whiteMaterial];
        $tests[] = ['expected' => 34.5, 'actual' => $blackMaterial];

        foreach ($tests as $test)
        {
            $this->assertEquals($test['expected'], $test['actual']);
        }
    }

    public function testGetSideMaterialCountAgainstWrongData()
    {
        $game = new Game();

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][2]->setPiece(null);
        $game->getBoard()[7][3]->setPiece(null);
        $game->getBoard()[8][8]->setPiece(null);

        $evaluateMaterial = new EvaluateMaterial($game);

        $whiteMaterial = $evaluateMaterial->getSideMaterialCount('white');
        $blackMaterial = $evaluateMaterial->getSideMaterialCount('black');

        $this->assertNotEquals($whiteMaterial, 40.5);
        $this->assertNotEquals($blackMaterial, 12);
    }
}