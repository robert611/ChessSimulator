<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use App\Model\Game;
use App\Model\GameAgainstComputer;

class GameController extends AbstractController
{
    /**
     * @Route("api/game/play/beetwen/computers", name="game_beetwen_computers")
     */
    public function playGameBeetwenComputers(): Response
    {
        $game = new Game();

        $game->playGame();

        $defaultContext = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => []
        ];

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $serializer = new Serializer($normalizers, $encoders);
        
        return new JsonResponse($serializer->serialize($game, 'json'));
    }

    /**
     * @Route("api/game/play/with/computer/{humanPiecesColor}", name="game_beetwen_human_and_computer")
     */
    public function playGameWithComputer($humanPiecesColor, GameAgainstComputer $gameModel): Response 
    {
        $gameFileName = $gameModel->startGame();
        
        $game = $gameModel->recreateGameFromFile($gameFileName);

        if ($humanPiecesColor == 'black') $gameModel->playAndSaveComputerMove($gameFileName, $game);

        $defaultContext = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => []
        ];

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $serializer = new Serializer($normalizers, $encoders);
        
        return new JsonResponse($serializer->serialize(['game_file_name' => $gameFileName, 'moves' => $game->getMoves()], 'json'));
    }

    /**
     * @Route("api/game/play/move/against/computer", name="play_move_against_computer")
     */
    public function playMoveAgainstComputer(Request $request, GameAgainstComputer $gameModel)
    {
        $defaultContext = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => []
        ];

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $serializer = new Serializer($normalizers, $encoders);

        $castle = $request->request->get('castle');
        $from = [$request->request->get('from_x'), $request->request->get('from_y')];
        $to = [$request->request->get('to_x'), $request->request->get('to_y')];
        $gameFileName = $request->request->get('game_file_name');

        $game = $gameModel->recreateGameFromFile($gameFileName);

        if(!$gameModel->isHumanMoveValid($game, [$from, $to], $castle)) {
            return new JsonResponse($serializer->serialize(['error' => 'Twój ruch jest nieprawidłowy'], 'json'));
        }

        $gameModel->playAndSaveHumanMove($gameFileName, [$from, $to], $castle, $game);

        if (!$game->checkIfGameHasEnded()) {
            $gameModel->playAndSaveComputerMove($gameFileName, $game);
        }

        return new JsonResponse($serializer->serialize($game, 'json'));
    }
}
