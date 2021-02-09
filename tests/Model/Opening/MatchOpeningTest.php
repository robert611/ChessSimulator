<?php 

namespace App\Tests\Model;

use App\Model\Board;
use App\Model\Game;
use PHPUnit\Framework\TestCase;
use App\Model\OpeningModule\MatchOpening;

class MatchOpeningTest extends TestCase
{
    private $matchOpening;

    public function setUp()
    {
        $this->matchOpening = new MatchOpening();
    }

    public function testIfOpeningArrayIsFilled()
    {
        $openings = $this->matchOpening->getOpenings();

        $this->assertTrue(isset($openings['english']));
    }

    public function testGetMatchingOpeningsNodes()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [5, 5]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);

        $matchingNodes = $this->matchOpening->getMatchingOpeningsNodes($game->getMoves());

        $expectedNodes = [[[8, 6], [4, 2]], [[8, 7], [6, 6]]];

        $potentialMoves = $this->matchOpening->getPositionPotentialMoves($matchingNodes[0][0]->getChildren());

        $this->assertTrue(in_array($matchingNodes[0][0]->getData(), $expectedNodes));
        $this->assertTrue(in_array($matchingNodes[0][1]->getData(), $expectedNodes));
        $this->assertTrue(in_array([[1, 4], [2, 3]], $potentialMoves));
    }

    public function testGetNextMoveForGivenOpenings()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [5, 5]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[8][6]->getPiece(), [4, 2]);
        $game->makeMove($game->getBoard()[3][3]->getPiece(), [5, 4]);

        $matchingNodes = $this->matchOpening->getMatchingOpeningsNodes($game->getMoves());

        $nextMove = $this->matchOpening->getNextMoveForGivenOpenings($matchingNodes);

        $expectedMoves = [[[8, 2], [6, 3]]];

        $this->assertTrue(in_array($nextMove, $expectedMoves));
    }

    public function testGetMovesCords()
    {
        $game = new Game();

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [5, 5]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);

        $movesCords = $this->matchOpening->getMovesCords($game->getMoves());

        $this->assertTrue($movesCords[0] == [[2, 3], [4, 3]]);
        $this->assertTrue($movesCords[1] == [[7, 5], [5, 5]]);
        $this->assertTrue($movesCords[2] == [[1, 2], [3, 3]]);
    }
}