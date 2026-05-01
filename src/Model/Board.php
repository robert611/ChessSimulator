<?php

declare(strict_types=1);

namespace App\Model;

use App\Dictionary\Coord;
use App\Dictionary\PieceColor;
use App\Model\Piece\Pawn;
use App\Model\Piece\Rook;
use App\Model\Piece\Knight;
use App\Model\Piece\Bishop;
use App\Model\Piece\Queen;
use App\Model\Piece\King;

class Board
{
    /** @var BoardSquare[] */
    private array $board;

    public function __construct()
    {
        $this->buildBoard();
    }

    private function buildBoard(): void
    {
        // TODO, mam nieprzyjemny problem, nie wiem czy nie podszedłem źle do przebudowy planszy
        // TODO, w wielu miejscach chcę ułatwić pisanie ruchów z notacji [1, 1] na 'A1'
        // TODO, jednak są miejsca gdzie notacja używająca dwuwymiarowej tablicy jest lepsza do obliczeń
        // TODO, myślę, że muszę w reszcie kodu inaczej korzystać z planszy, nie jako tablicy a obiektu
        // TODO, w środku plansza będzie mieć notację zarówno liczbową jak i numeryczną

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $color = ($i % 2) !== ($j % 2) ? PieceColor::WHITE : PieceColor::BLACK;
                $coord = Coord::toString($i, $j);
                $this->board[$coord] = new BoardSquare([$i, $j], $color);
            }
        }

        $this->fillBoard();
    }

    private function fillBoard(): void
    {
        $this->board[Coord::A1->value]->setPiece(new Rook([1,1], 'white'));
        $this->board[Coord::B1->value]->setPiece(new Knight([1,2], 'white'));
        $this->board[Coord::C1->value]->setPiece(new Bishop([1,3], 'white'));
        $this->board[Coord::D1->value]->setPiece(new Queen([1,4], 'white'));
        $this->board[Coord::E1->value]->setPiece(new King([1,5], 'white'));
        $this->board[Coord::F1->value]->setPiece(new Bishop([1,6], 'white'));
        $this->board[Coord::G1->value]->setPiece(new Knight([1,7], 'white'));
        $this->board[Coord::H1->value]->setPiece(new Rook([1,8], 'white'));

        for ($i = 1; $i <= 8; $i++) {
            $coord = Coord::toString(2, $i);
            $this->board[$coord]->setPiece(new Pawn([2, $i], 'white'));
        }

        for ($k = 3; $k <= 6; $k++) {
            for ($j = 1; $j <= 8; $j++) {
                $coord = Coord::toString($k, $j);
                $this->board[$coord]->setPiece(null);
            }
        }

        for ($f = 1; $f <= 8; $f++) {
            $coord = Coord::toString(7, $f);
            $this->board[$coord]->setPiece(new Pawn([7, $f], 'black'));
        }

        $this->board[Coord::A8->value]->setPiece(new Rook([8,1], 'black'));
        $this->board[Coord::B8->value]->setPiece(new Knight([8,2], 'black'));
        $this->board[Coord::C8->value]->setPiece(new Bishop([8,3], 'black'));
        $this->board[Coord::D8->value]->setPiece(new Queen([8,4], 'black'));
        $this->board[Coord::E8->value]->setPiece(new King([8,5], 'black'));
        $this->board[Coord::F8->value]->setPiece(new Bishop([8,6], 'black'));
        $this->board[Coord::G8->value]->setPiece(new Knight([8,7], 'black'));
        $this->board[Coord::H8->value]->setPiece(new Rook([8,8], 'black'));
    }

    public function getBoardInStringNotation(): array
    {
        return $this->board;
    }

    public function getBoardInNumericalNotation(): array
    {
        $result = [];

        foreach ($this->board as $coordKey => $boardSquare) {
            $coord = Coord::tryFrom($coordKey);
            $arrayCoord = $coord->toArray();

            $result[$arrayCoord[0]][$arrayCoord[1]] = $boardSquare;
        }

        return $result;
    }

    public function getSquare(string|Coord $coord): BoardSquare
    {
        if (is_string($coord)) {
            return $this->board[$coord];
        }

        return $this->board[$coord->value];
    }

    public function getSquareByNumericalCoords(array $cords): BoardSquare
    {
        $coord = Coord::toString($cords[0], $cords[1]);

        return $this->board[$coord];
    }

    public function getSquareByNumericalNotation(int $vertical, int $horizontal): BoardSquare
    {
        $coord = Coord::toString($vertical, $horizontal);

        return $this->board[$coord];
    }

    public function cloneBoard(): Board
    {
        return clone $this;
    }
}
