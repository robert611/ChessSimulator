<?php 

namespace App\Model;

use App\Model\SecretGenerator;
use App\Model\Game;

class GameAgainstComputer
{
    private $secretGenerator;
    private $gameFolder;
    
    public function __construct($gameFolder)
    {
        $this->secretGenerator = new SecretGenerator();
        $this->gameFolder = $gameFolder;
    }

    public function startGame(): string
    {
        do {
            $gameFileName = $this->secretGenerator->generate();
        } while(file_exists("{$this->gameFolder}/{$gameFileName}.txt"));

        $file = fopen("{$this->gameFolder}/{$gameFileName}.txt", "w");

        return $gameFileName;
    }

    public function saveMove(string $gameFileName, array $move): void
    {        
        $gameFile = fopen("{$this->gameFolder}${gameFileName}.txt", "a+");

        fwrite($gameFile, json_encode($move) . "\n");

        fclose($gameFile);
    }

    public function isHumanMoveValid(object $game, array $humanMove, ?string $castle): bool
    {
        $sideToMove = $game->getSideToMove();

        if ($castle == 'long' or $castle == 'short') {
            $castleMoves = [];
            
            $sideToMoveKing = $game->getPieceSquare('king', $sideToMove)->getPiece();

            foreach ($sideToMoveKing->getPossibleMoves($game) as $move) {
                if (isset($move[0]['from'])) {
                    $castleMoves[] = $move;
                }
            }

            if (empty($castleMoves) ) {
                return false;
            } else if (count($castleMoves) == 1) {
                if ($castle == 'short') {
                    if ($castleMoves[0][0]['to'] == [1, 7] or $castleMoves[0][0]['to'] == [8, 7]) return true;
                } else if ($castle == 'long') {
                    if ($castleMoves[0][0]['to'] == [1, 3] or $castleMoves[0][0]['to'] == [8, 3]) return true;
                } 

                return false;
            } else if (count($castleMoves) == 2) {
                return true;
            }
        }

        $piece = $game->getBoard()[$humanMove[0][0]][$humanMove[0][1]]->getPiece();

        if ($piece == null) return false;

        if ($piece->getSide() !== $sideToMove) return false;

        $possibleMoves = $piece->getPossibleMoves($game);

        /* If move is encounterd in piece possible moves then it is legal so return true, if not then at the end of the function false is returned */
        foreach ($possibleMoves as $move) {
            if ($move == $humanMove[1]) return true;
        }

        return false;
    }

    /*
        humanMove -> [[], []] first array is 'from' coords and second 'to' coords
    */
    public function playAndSaveHumanMove(string $gameFileName, array $humanMove, ?string $castle, object $game): void
    {
        if ($game->checkIfGameHasEnded()) {
            return;
        }

        if ($castle == 'long' or $castle == 'short')
        {
            $sideToMove = $game->getSideToMove();

            $sideToMoveKing = $game->getPieceSquare('king', $sideToMove)->getPiece();

            $kingPosition = $sideToMoveKing->getKingPositionBeforeAndAfterCastle();
            $rookPosition = $sideToMoveKing->getRookPositionBeforeAndAfterCastle();

            $kingPositionBefore = $kingPosition[$castle]['king']['before'];

            $humanMove = [['from' => $kingPositionBefore, 'to' => $kingPosition[$castle]['king']['after']],
                ['from' => $rookPosition[$castle]['rook']['before'], 'to' => $rookPosition[$castle]['rook']['after']]];
            
            $game->makeMove($game->getBoard()[$kingPositionBefore[0]][$kingPositionBefore[1]]->getPiece(), $humanMove);

        } else $game->makeMove($game->getBoard()[$humanMove[0][0]][$humanMove[0][1]]->getPiece(), $humanMove[1]);

        $this->saveMove($gameFileName, $humanMove);

        /* If human move caused checkmate or draw, save results */
        if ($game->checkIfGameHasEnded()) {
            $game->saveResultInCaseOfCheckmate();
        }
    }

    public function playAndSaveComputerMove(string $gameFileName, object $game): void
    {
        $game->playComputerMove();

        /* Save Move to game file */
        $lastMove = $game->getLastMove();
        $this->saveMove($gameFileName, [$lastMove['previous_cords'], $lastMove['new_cords_square']->getCords()]);

        /* If computer move caused checkmate or draw, save results */
        if ($game->checkIfGameHasEnded()) {
            $game->saveResultInCaseOfCheckmate();
        }
    }

    public function recreateGameFromFile($gameFileName)
    {
        $game = new Game();

        $gameFile = fopen("{$this->gameFolder}${gameFileName}.txt", "r");

        while (!feof($gameFile)) {
            $move = json_decode(fgets($gameFile), true);

            if ($move == null) continue;
            
            if (isset($move[0]['from'])) {
                $game->makeMove($game->getBoard()[$move[0]['from'][0]][$move[0]['from'][1]]->getPiece(), $move);
                continue;
            }

            $game->makeMove($game->getBoard()[$move[0][0]][$move[0][1]]->getPiece(), $move[1]);
        }

        fclose($gameFile);

        return $game;
    }
}