<?php 

declare(strict_types=1);

namespace App\Tests\Model\Opening;

use App\Dictionary\Coord;
use App\Model\Game;
use App\Model\OpeningModule\MatchOpening;
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function it_matches_opening_moves(): void
    {
        // given
        $game = new Game();

        // and given
        $game->makeMove($game->getBoard()->getSquare('C2')->getPiece(), Coord::C4);
        $game->makeMove($game->getBoard()->getSquare('E7')->getPiece(), Coord::E5);
        $game->makeMove($game->getBoard()->getSquare('B1')->getPiece(), Coord::C3);

        // when
        $matchingNodes = $this->matchOpening->getMatchingOpeningsNodes($game->getMoves());
        $potentialMoves = $this->matchOpening->getPositionPotentialMoves($matchingNodes[0]->getChildren());

        // then
        $expectedNodes = [
            [
                Coord::F8->toArray(),
                Coord::B4->toArray(),
            ],
            [
                Coord::G8->toArray(),
                Coord::F6->toArray(),
            ],
        ];
        self::assertTrue(in_array($matchingNodes[0]->getData(), $expectedNodes));
        self::assertTrue(in_array($matchingNodes[1]->getData(), $expectedNodes));
        self::assertTrue(in_array([Coord::D1->toArray(), Coord::C2->toArray()], $potentialMoves));
    }

    #[Test]
    public function it_returns_next_moves_in_giving_opening(): void
    {
        // given
        $game = new Game();

        // and given
        $game->makeMove($game->getBoard()->getSquare('C2')->getPiece(), Coord::C4);
        $game->makeMove($game->getBoard()->getSquare('E7')->getPiece(), Coord::E5);
        $game->makeMove($game->getBoard()->getSquare('B1')->getPiece(), Coord::C3);
        $game->makeMove($game->getBoard()->getSquare('F8')->getPiece(), Coord::B4);
        $game->makeMove($game->getBoard()->getSquare('C3')->getPiece(), Coord::D5);

        // when
        $matchingNodes = $this->matchOpening->getMatchingOpeningsNodes($game->getMoves());
        $nextMove = $this->matchOpening->getNextMoveForGivenOpenings($matchingNodes);

        // then
        $expectedMoves = [
            [
                Coord::B8->toArray(),
                Coord::C6->toArray(),
            ],
        ];
        self::assertTrue(in_array($nextMove, $expectedMoves));
    }

    #[Test]
    public function it_transforms_move_cords_to_format_understandable_by_opening_matcher(): void
    {
        // given
        $game = new Game();

        // and given
        $game->makeMove($game->getBoard()->getSquare('C2')->getPiece(), Coord::C4);
        $game->makeMove($game->getBoard()->getSquare('E7')->getPiece(), Coord::E5);
        $game->makeMove($game->getBoard()->getSquare('B1')->getPiece(), Coord::C3);

        // when
        $movesCords = $this->matchOpening->getMovesCords($game->getMoves());

        self::assertSame([[2, 3], [4, 3]], $movesCords[0]);
        self::assertSame([[7, 5], [5, 5]], $movesCords[1]);
        self::assertSame([[1, 2], [3, 3]], $movesCords[2]);
    }
}
