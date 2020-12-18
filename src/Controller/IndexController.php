<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Game;
use App\Model\Piece\King;
use App\Model\Piece\Quenn;
use App\Model\Piece\Rook;
use App\Model\Piece\Knight;
use App\Model\Piece\Bishop;
use App\Model\Piece\Pawn;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $game = new Game();

        return $this->render('index/index.html.twig', [
           'game' => $game
        ]);
    }
}
