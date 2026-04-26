<?php 

declare(strict_types=1);

namespace App\Tests\Model\Opening;

use App\Dictionary\Coord;
use App\Model\Game;
use App\Model\OpeningModule\MatchOpening;
use PHPUnit\Framework\TestCase;

class MatchOpeningTest extends TestCase
{
    private MatchOpening $matchOpening;

    public function setUp(): void
    {
        $this->matchOpening = new MatchOpening();
    }

    public function testIfOpeningArrayIsFilled(): void
    {
        // when
        $openings = $this->matchOpening->getOpenings();

        // then
        self::assertTrue(isset($openings['english']));
    }

    public function testGetMatchingOpeningsNodes(): void
    {
        // given
        $game = new Game();

        // and given
        $game->makeMove($game->getBoard()[2][3]->getPiece(), Coord::C4);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), Coord::E5);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), Coord::C3);

        // when
        $matchingNodes = $this->matchOpening->getMatchingOpeningsNodes($game->getMoves());

        // then
        $expectedNodes = [[[8, 6], [4, 2]], [[8, 7], [6, 6]]];
        $potentialMoves = $this->matchOpening->getPositionPotentialMoves($matchingNodes[0][0]->getChildren());
        self::assertTrue(in_array($matchingNodes[0][0]->getData(), $expectedNodes));
        self::assertTrue(in_array($matchingNodes[0][1]->getData(), $expectedNodes));
        self::assertTrue(in_array([[1, 4], [2, 3]], $potentialMoves));
    }

    public function testGetNextMoveForGivenOpenings(): void
    {
        // given
        $game = new Game();

        // and given
        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [5, 5]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[8][6]->getPiece(), [4, 2]);
        $game->makeMove($game->getBoard()[3][3]->getPiece(), [5, 4]);

        // when
        $matchingNodes = $this->matchOpening->getMatchingOpeningsNodes($game->getMoves());
        $nextMove = $this->matchOpening->getNextMoveForGivenOpenings($matchingNodes);

        // then
        $expectedMoves = [[[8, 2], [6, 3]]];
        self::assertTrue(in_array($nextMove, $expectedMoves));
    }

    public function testGetMovesCords(): void
    {
        // given
        $game = new Game();

        // and given
        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [5, 5]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);

        // when
        $movesCords = $this->matchOpening->getMovesCords($game->getMoves());

        self::assertSame([[2, 3], [4, 3]], $movesCords[0]);
        self::assertSame([[7, 5], [5, 5]], $movesCords[1]);
        self::assertSame([[1, 2], [3, 3]], $movesCords[2]);
    }
}
