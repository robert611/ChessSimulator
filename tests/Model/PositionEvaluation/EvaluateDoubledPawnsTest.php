<?php 

namespace App\Tests\Model\PositionEvaluation;

use App\Model\Game;
use PHPUnit\Framework\TestCase;
use App\Model\PositionEvaluation\EvaluateDoubledPawns;

class EvaluateDoubledPawnsTest extends TestCase
{
    public function testGetEvaluation()
    {
        $tests = array();

        /* Situation 1 */
        $game = new Game();

        $game->getBoard()[7][7]->setPiece(null);
        
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 2]);
        $game->makeMove($game->getBoard()[7][3]->getPiece(), [5, 2]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 6]);

        $game->makeMove($game->getBoard()[2][5]->getPiece(), [3, 6]);
        $game->makeMove($game->getBoard()[2][3]->getPiece(), [3, 4]);
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [4, 4]);
        $game->makeMove($game->getBoard()[2][1]->getPiece(), [5, 4]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $evaluation = $evaluateDoubledPawns->getEvaluation();

        $tests[] = ['expected' => -0.2, 'actual' => $evaluation];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[7][7]->setPiece(null);
        
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 2]);
        $game->makeMove($game->getBoard()[7][3]->getPiece(), [5, 2]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 6]);

        $game->makeMove($game->getBoard()[2][5]->getPiece(), [3, 6]);
        $game->makeMove($game->getBoard()[2][3]->getPiece(), [3, 4]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $evaluation = $evaluateDoubledPawns->getEvaluation();

        $tests[] = ['expected' => 0.2, 'actual' => $evaluation];

        /* Situation 3 */
        $game = new Game();

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [3, 7]);
        $game->makeMove($game->getBoard()[2][8]->getPiece(), [4, 7]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $evaluation = $evaluateDoubledPawns->getEvaluation();

        $tests[] = ['expected' => -0.4, 'actual' => $evaluation];

        /* Situation 4 */
        $game = new Game();
    
        $game->getBoard()[2][7]->setPiece(null);

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [3, 7]);
        $game->makeMove($game->getBoard()[2][8]->getPiece(), [4, 7]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $evaluation = $evaluateDoubledPawns->getEvaluation();

        $tests[] = ['expected' => -0.2, 'actual' => $evaluation];

        /* Situation 5 */
        $game = new Game();
    
        $game->getBoard()[2][7]->setPiece(null);

        $game->makeMove($game->getBoard()[2][6]->getPiece(), [3, 7]);
        $game->makeMove($game->getBoard()[2][8]->getPiece(), [4, 7]);

        $game->makeMove($game->getBoard()[7][6]->getPiece(), [5, 5]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $evaluation = $evaluateDoubledPawns->getEvaluation();

        $tests[] = ['expected' => 0, 'actual' => $evaluation];

        foreach ($tests as $test)
        {
            $this->assertEquals($test['expected'], $test['actual']);
        }
    }

    public function testGetNumberOfDoubledPawns()
    {
        $tests = array();

        /* Situation 1 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);
        
        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $whiteDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('white');
        $blackDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('black');

        $tests[] = ['expected' => 0, 'actual' => $whiteDoubledPawnsNumber];
        $tests[] = ['expected' => 0, 'actual' => $blackDoubledPawnsNumber];

        /* Situation 2 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 3]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $whiteDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('white');
        $blackDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('black');

        $tests[] = ['expected' => 1, 'actual' => $whiteDoubledPawnsNumber];
        $tests[] = ['expected' => 0, 'actual' => $blackDoubledPawnsNumber];

        /* Situation 3 */
        $game = new Game();

        $game->getBoard()[2][6]->setPiece(null);

        $game->getBoard()[7][1]->setPiece(null);
        $game->getBoard()[7][4]->setPiece(null);

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 3]);

        $game->makeMove($game->getBoard()[7][2]->getPiece(), [6, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 6]);
        $game->makeMove($game->getBoard()[7][7]->getPiece(), [5, 6]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $whiteDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('white');
        $blackDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('black');

        $tests[] = ['expected' => 1, 'actual' => $whiteDoubledPawnsNumber];
        $tests[] = ['expected' => 3, 'actual' => $blackDoubledPawnsNumber];

        /* Situation 4 */
        $game = new Game();

        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[1][7]->getPiece(), [3, 6]);
        $game->makeMove($game->getBoard()[2][5]->getPiece(), [3, 5]);
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 4]);

        $game->makeMove($game->getBoard()[7][2]->getPiece(), [6, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 6]);
        $game->makeMove($game->getBoard()[7][7]->getPiece(), [5, 6]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $whiteDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('white');
        $blackDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('black');

        $tests[] = ['expected' => 0, 'actual' => $whiteDoubledPawnsNumber];
        $tests[] = ['expected' => 3, 'actual' => $blackDoubledPawnsNumber];

        /* Situation 5 */
        $game = new Game();

        $game->getBoard()[7][7]->setPiece(null);
        
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 2]);
        $game->makeMove($game->getBoard()[7][3]->getPiece(), [5, 2]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [6, 6]);

        $game->makeMove($game->getBoard()[2][5]->getPiece(), [3, 6]);
        $game->makeMove($game->getBoard()[2][3]->getPiece(), [3, 4]);
        $game->makeMove($game->getBoard()[2][2]->getPiece(), [4, 4]);
        $game->makeMove($game->getBoard()[2][1]->getPiece(), [5, 4]);

        $evaluateDoubledPawns = new EvaluateDoubledPawns($game);

        $whiteDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('white');
        $blackDoubledPawnsNumber = $evaluateDoubledPawns->getNumberOfDoubledPawns('black');

        $tests[] = ['expected' => 4, 'actual' => $whiteDoubledPawnsNumber];
        $tests[] = ['expected' => 3, 'actual' => $blackDoubledPawnsNumber];

        foreach ($tests as $test)
        {
            $this->assertEquals($test['expected'], $test['actual']);
        }
    }
}