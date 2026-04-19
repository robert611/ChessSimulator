<?php 

declare(strict_types=1);

namespace App\Tests\Model\PositionEvaluation;

use App\Model\GameAgainstComputer;
use App\Model\OpeningModule\MatchOpening;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameAgainstComputerTest extends KernelTestCase
{
    private GameAgainstComputer $gameAgainstComputer;

    protected function setUp(): void
    {
        $this->gameAgainstComputer = self::getContainer()->get(GameAgainstComputer::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        self::ensureKernelShutdown();
    }

    public function testIfGameCanBeStarted(): void
    {
        $gameFolder = self::getContainer()->get('kernel')->getProjectDir() . "/public/assets/games/";

        $gameFileName = $this->gameAgainstComputer->startGame();

        $this->assertTrue(file_exists("$gameFolder/$gameFileName.txt"));
    }

    public function testIfMoveCanBeSaved(): void
    {
        $gameFolder = self::getContainer()->get('kernel')->getProjectDir() . "/public/assets/games/";

        $gameFileName = $this->gameAgainstComputer->startGame();

        $move = [[2, 4], [4, 4]];

        $this->gameAgainstComputer->saveMove($gameFileName, $move);

        $recreatedGame = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        $actualMove = [$recreatedGame->getMoves()[0]['previous_cords'], $recreatedGame->getMoves()[0]['new_cords_square']->getCords()];

        $this->assertEquals($actualMove, $move);
    }

    public function testIfHumanMoveIsValid(): void
    {
        $gameFileName = $this->gameAgainstComputer->startGame();

        $game = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        /* Make room for queen, king and rook to move */
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 4]);
        $game->makeMove($game->getBoard()[7][1]->getPiece(), [6, 1]);
        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);
        $game->makeMove($game->getBoard()[6][1]->getPiece(), [5, 1]);

        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [[4, 4], [5, 4]], null));
        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 7], [3, 6]], null));
        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [[3, 1], [4, 1]], null));
        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 4], [3, 4]], null));
        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 5], [2, 4]], null));
        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 3], [2, 4]], null));
        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 1], [2, 1]], null));
    }

    public function testIfCastleMoveIsValid(): void
    {
        $gameFileName = $this->gameAgainstComputer->startGame();

        $game = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        /* Make castling possible */
        $game->makeMove($game->getBoard()[2][4]->getPiece(), [4, 4]);
        $game->makeMove($game->getBoard()[7][4]->getPiece(), [5, 4]);
        $game->makeMove($game->getBoard()[2][5]->getPiece(), [4, 5]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [5, 5]);
        $game->makeMove($game->getBoard()[1][6]->getPiece(), [2, 5]);
        $game->makeMove($game->getBoard()[8][6]->getPiece(), [7, 5]);
        $game->makeMove($game->getBoard()[1][7]->getPiece(), [3, 6]);
        $game->makeMove($game->getBoard()[8][7]->getPiece(), [6, 6]);
        $game->makeMove($game->getBoard()[1][4]->getPiece(), [3, 4]);
        $game->makeMove($game->getBoard()[8][4]->getPiece(), [6, 4]);
        $game->makeMove($game->getBoard()[1][3]->getPiece(), [2, 4]);
        $game->makeMove($game->getBoard()[8][3]->getPiece(), [7, 4]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);
        $game->makeMove($game->getBoard()[8][2]->getPiece(), [6, 3]);

        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [], 'short'));
        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [], 'long'));

        /* Move so black can move, and create situation in which you can castle in one way */
        $game->makeMove($game->getBoard()[2][1]->getPiece(), [3, 1]);
        $game->makeMove($game->getBoard()[7][4]->getPiece(), [8, 3]);
        $game->makeMove($game->getBoard()[3][1]->getPiece(), [4, 1]);

        $this->assertTrue($this->gameAgainstComputer->isHumanMoveValid($game, [], 'short'));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [], 'long'));
    }

    public function testIfHumanMoveIsInvalid(): void
    {
        $gameFileName = $this->gameAgainstComputer->startGame();

        $game = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [[2, 4], [5, 4]], null));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [], 'short'));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [], 'long'));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 3], [2, 2]], null));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 4], [2, 4]], null));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [[1, 5], [2, 5]], null));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [[7, 5], [5, 5]], null));
        $this->assertFalse($this->gameAgainstComputer->isHumanMoveValid($game, [[8, 2], [6, 3]], null));
    }

    public function testIfHumanMoveCanBePlayed(): void
    {
        $gameFileName = $this->gameAgainstComputer->startGame();

        $game = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        $this->gameAgainstComputer->playAndSaveHumanMove($gameFileName, [[2, 1], [4, 1]], null, $game);

        /* Check if move was correctly saved in game file */
        $gameWithNewMove = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        $this->assertTrue(count($gameWithNewMove->getMoves()) == 1);
        $this->assertTrue($gameWithNewMove->getMoves()[0]['previous_cords'] == [2, 1]);
        $this->assertTrue($gameWithNewMove->getMoves()[0]['new_cords_square']->getCords() == [4, 1]);
        $this->assertTrue($gameWithNewMove->getMoves()[0]['piece']->getName() == 'pawn');

    }

    public function testIfComputerMoveCanBePlayed(): void
    {
        $gameFileName = $this->gameAgainstComputer->startGame();

        $game = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        $this->gameAgainstComputer->playAndSaveComputerMove($gameFileName, $game);

        $gameMove = $game->getMoves()[0];

        /* Check if move was correctly saved in game file */
        $gameWithNewMove = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        $recreatedMove = $gameWithNewMove->getMoves()[0];

        $this->assertTrue(count($gameWithNewMove->getMoves()) == 1);
        $this->assertTrue($recreatedMove['previous_cords'] == $gameMove['previous_cords']);
        $this->assertTrue($recreatedMove['new_cords_square']->getCords() == $gameMove['new_cords_square']->getCords());
        $this->assertTrue($recreatedMove['piece']->getName() == $gameMove['piece']->getName());
    }

    public function testIfComputerMoveFromOpeningTheoryCanBePlayed(): void
    {
        $matchOpening = new MatchOpening();

        $gameFileName = $this->gameAgainstComputer->startGame();

        $game = $this->gameAgainstComputer->recreateGameFromFile($gameFileName);

        $game->makeMove($game->getBoard()[2][3]->getPiece(), [4, 3]);
        $game->makeMove($game->getBoard()[7][5]->getPiece(), [5, 5]);
        $game->makeMove($game->getBoard()[1][2]->getPiece(), [3, 3]);

        $matchingNodes = $matchOpening->getMatchingOpeningsNodes($game->getMoves());
        $potentialMoves = $matchOpening->getPositionPotentialMoves($matchingNodes);

        $this->gameAgainstComputer->playAndSaveComputerMove($gameFileName, $game);

        $playedMove = $game->getMoves()[count($game->getMoves()) - 1];

        $playedMove = [$playedMove['previous_cords'], $playedMove['new_cords_square']->getCords()];

        $this->assertTrue(in_array($playedMove, $potentialMoves));
    } 

    public function testIfGameCanBeRecreatedFromFile(): void
    {
        $gameAgainstComputer = new GameAgainstComputer(self::getContainer()->getParameter('games_directory') . "test/");

        $gameFileName = "TESTGAME";
        
        $game = $gameAgainstComputer->recreateGameFromFile($gameFileName);

        $this->assertTrue(count($game->getMoves()) == 13);
        $this->assertTrue($game->getBoard()[5][4]->getPiece()->getSide() == 'black');
        $this->assertTrue($game->getBoard()[2][7]->getPiece()->getName() == 'bishop');
        $this->assertTrue(str_contains($game->getPositions()[12]['position'][5][3], 'App\Model\Piece\Bishop'));
        $this->assertTrue($game->getResult()['result'] == '');
        $this->assertTrue($game->getResult()['type'] == '');
    }
}
