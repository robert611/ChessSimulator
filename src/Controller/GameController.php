<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use App\Model\Game;

class GameController extends AbstractController
{
    /**
     * @Route("api/game/play", name="game")
     */
    public function playGame(): Response
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
}
