<?php 

declare(strict_types=1);

namespace App\Tests\Model\Piece\King;

use App\Dictionary\Coord;
use App\Dictionary\PieceColor;
use App\Model\Game;
use App\Model\Piece\Rook;
use App\Model\Piece\Queen;
use App\Model\Piece\Bishop;
use App\Model\Piece\King;
use App\Model\Piece\Knight;
use App\Model\Piece\Pawn;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CheckIfKingIsInCheckmateTest extends TestCase
{
    #[Test]
    public function test_if_king_is_in_checkmate_1(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given (setup kings)
        $board[Coord::C2->value]->setPiece(new King(Coord::C2->toArray(), PieceColor::WHITE->value));
        $board[Coord::F8->value]->setPiece(new King(Coord::F8->toArray(), PieceColor::BLACK->value));

        // and given (white rooks are on 7 and 8 line giving black a checkmate)
        $board[Coord::A8->value]->setPiece(new Rook(Coord::A8->toArray(), PieceColor::WHITE->value));
        $board[Coord::B7->value]->setPiece(new Rook(Coord::B7->toArray(), PieceColor::WHITE->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::F8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertTrue($result);
    }

    #[Test]
    public function test_if_king_is_in_checkmate_2(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::A5->value]->setPiece(new King(Coord::A5->toArray(), PieceColor::BLACK->value));
        $board[Coord::C4->value]->setPiece(new King(Coord::C4->toArray(), PieceColor::WHITE->value));
        $board[Coord::B5->value]->setPiece(new Queen(Coord::B5->toArray(), PieceColor::WHITE->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::A5->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertTrue($result);
    }

    #[Test]
    public function test_if_king_is_in_checkmate_3(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::G8->value]->setPiece(new King(Coord::G8->toArray(), PieceColor::BLACK->value));
        $board[Coord::G1->value]->setPiece(new King(Coord::G1->toArray(), PieceColor::WHITE->value));

        $board[Coord::F7->value]->setPiece(new Pawn(Coord::F7->toArray(), PieceColor::BLACK->value));
        $board[Coord::G7->value]->setPiece(new Pawn(Coord::G7->toArray(), PieceColor::BLACK->value));
        $board[Coord::H6->value]->setPiece(new Pawn(Coord::H6->toArray(), PieceColor::BLACK->value));

        $board[Coord::F2->value]->setPiece(new Pawn(Coord::F2->toArray(), PieceColor::WHITE->value));
        $board[Coord::G2->value]->setPiece(new Pawn(Coord::G2->toArray(), PieceColor::WHITE->value));
        $board[Coord::H3->value]->setPiece(new Pawn(Coord::H3->toArray(), PieceColor::WHITE->value));

        $board[Coord::D3->value]->setPiece(new Bishop(Coord::D3->toArray(), PieceColor::WHITE->value));
        $board[Coord::C3->value]->setPiece(new Knight(Coord::C3->toArray(), PieceColor::BLACK->value));
        $board[Coord::B2->value]->setPiece(new Rook(Coord::B2->toArray(), PieceColor::BLACK->value));

        $board[Coord::D8->value]->setPiece(new Rook(Coord::D8->toArray(), PieceColor::WHITE->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::G8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertTrue($result);
    }

    #[Test]
    public function test_if_king_is_in_checkmate_4(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::E5->value]->setPiece(new King(Coord::E5->toArray(), PieceColor::BLACK->value));
        $board[Coord::G1->value]->setPiece(new King(Coord::G1->toArray(), PieceColor::WHITE->value));

        $board[Coord::E4->value]->setPiece(new Pawn(Coord::E4->toArray(), PieceColor::WHITE->value));
        $board[Coord::E3->value]->setPiece(new Pawn(Coord::E3->toArray(), PieceColor::WHITE->value));

        $board[Coord::D5->value]->setPiece(new Bishop(Coord::D5->toArray(), PieceColor::WHITE->value));
        $board[Coord::F6->value]->setPiece(new Bishop(Coord::F6->toArray(), PieceColor::WHITE->value));
        $board[Coord::E8->value]->setPiece(new Knight(Coord::E8->toArray(), PieceColor::WHITE->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::E5->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertTrue($result);
    }

    #[Test]
    public function test_if_king_is_in_checkmate_5(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::H8->value]->setPiece(new King(Coord::H8->toArray(), PieceColor::BLACK->value));
        $board[Coord::F1->value]->setPiece(new King(Coord::F1->toArray(), PieceColor::WHITE->value));

        $board[Coord::D4->value]->setPiece(new Bishop(Coord::D4->toArray(), PieceColor::WHITE->value));
        $board[Coord::F7->value]->setPiece(new Bishop(Coord::F7->toArray(), PieceColor::WHITE->value));

        $board[Coord::H7->value]->setPiece(new Pawn(Coord::H7->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::H8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertTrue($result);
    }

    #[Test]
    public function test_if_king_is_in_checkmate_6(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::G8->value]->setPiece(new King(Coord::G8->toArray(), PieceColor::BLACK->value));
        $board[Coord::H1->value]->setPiece(new King(Coord::H1->toArray(), PieceColor::WHITE->value));

        /* Pawns */
        $board[Coord::A2->value]->setPiece(new Pawn(Coord::A2->toArray(), PieceColor::WHITE->value));
        $board[Coord::F2->value]->setPiece(new Pawn(Coord::F2->toArray(), PieceColor::WHITE->value));
        $board[Coord::H2->value]->setPiece(new Pawn(Coord::H2->toArray(), PieceColor::WHITE->value));
        $board[Coord::F3->value]->setPiece(new Pawn(Coord::F3->toArray(), PieceColor::WHITE->value));
        $board[Coord::E4->value]->setPiece(new Pawn(Coord::E4->toArray(), PieceColor::WHITE->value));

        $board[Coord::A7->value]->setPiece(new Pawn(Coord::A7->toArray(), PieceColor::BLACK->value));
        $board[Coord::B7->value]->setPiece(new Pawn(Coord::B7->toArray(), PieceColor::BLACK->value));
        $board[Coord::F7->value]->setPiece(new Pawn(Coord::F7->toArray(), PieceColor::BLACK->value));
        $board[Coord::H7->value]->setPiece(new Pawn(Coord::H7->toArray(), PieceColor::BLACK->value));
        $board[Coord::D6->value]->setPiece(new Pawn(Coord::D6->toArray(), PieceColor::BLACK->value));
        $board[Coord::D5->value]->setPiece(new Pawn(Coord::D5->toArray(), PieceColor::BLACK->value));

        /* Rooks */
        $board[Coord::G5->value]->setPiece(new Rook(Coord::G5->toArray(), PieceColor::WHITE->value));
        $board[Coord::C8->value]->setPiece(new Rook(Coord::C8->toArray(), PieceColor::BLACK->value));
        $board[Coord::F8->value]->setPiece(new Rook(Coord::F8->toArray(), PieceColor::BLACK->value));

        /* Knights */
        $board[Coord::E2->value]->setPiece(new Knight(Coord::E2->toArray(), PieceColor::WHITE->value));
        $board[Coord::C4->value]->setPiece(new Knight(Coord::C4->toArray(), PieceColor::BLACK->value));

        /* Bishops */
        $board[Coord::B2->value]->setPiece(new Bishop(Coord::B2->toArray(), PieceColor::WHITE->value));
        $board[Coord::B6->value]->setPiece(new Bishop(Coord::B6->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::G8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertTrue($result);
    }

    #[Test]
    public function test_if_king_is_in_checkmate_7(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::G8->value]->setPiece(new King(Coord::G8->toArray(), PieceColor::BLACK->value));
        $board[Coord::H1->value]->setPiece(new King(Coord::H1->toArray(), PieceColor::WHITE->value));

        /* Rooks */
        $board[Coord::B8->value]->setPiece(new Rook(Coord::B8->toArray(), PieceColor::WHITE->value));
        $board[Coord::C7->value]->setPiece(new Rook(Coord::C7->toArray(), PieceColor::WHITE->value));
        $board[Coord::G5->value]->setPiece(new Queen(Coord::G5->toArray(), PieceColor::WHITE->value));

        /* Bishops */
        $board[Coord::D4->value]->setPiece(new Bishop(Coord::D4->toArray(), PieceColor::WHITE->value));
        $board[Coord::G6->value]->setPiece(new Bishop(Coord::G6->toArray(), PieceColor::BLACK->value));
        $board[Coord::B6->value]->setPiece(new Bishop(Coord::B6->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::G8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertTrue($result);
    }

    #[Test]
    public function test_if_king_is_not_in_checkmate_1(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::B8->value]->setPiece(new King(Coord::B8->toArray(), PieceColor::BLACK->value));
        $board[Coord::B6->value]->setPiece(new King(Coord::B6->toArray(), PieceColor::WHITE->value));

        $board[Coord::C8->value]->setPiece(new Queen(Coord::C8->toArray(), PieceColor::WHITE->value));
        $board[Coord::B7->value]->setPiece(new Pawn(Coord::B7->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::B8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    #[Test]
    public function test_if_king_is_not_in_checkmate_2(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::E8->value]->setPiece(new King(Coord::E8->toArray(), PieceColor::BLACK->value));
        $board[Coord::E6->value]->setPiece(new King(Coord::E6->toArray(), PieceColor::WHITE->value));

        $board[Coord::D6->value]->setPiece(new Queen(Coord::D6->toArray(), PieceColor::WHITE->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::E8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    #[Test]
    public function test_if_king_is_not_in_checkmate_3(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::H8->value]->setPiece(new King(Coord::H8->toArray(), PieceColor::BLACK->value));
        $board[Coord::D2->value]->setPiece(new King(Coord::D2->toArray(), PieceColor::WHITE->value));

        /* Pawns */
        $board[Coord::A2->value]->setPiece(new Pawn(Coord::A2->toArray(), PieceColor::WHITE->value));
        $board[Coord::B2->value]->setPiece(new Pawn(Coord::B2->toArray(), PieceColor::WHITE->value));
        $board[Coord::C2->value]->setPiece(new Pawn(Coord::C2->toArray(), PieceColor::WHITE->value));
        $board[Coord::F5->value]->setPiece(new Pawn(Coord::F5->toArray(), PieceColor::WHITE->value));
        $board[Coord::E6->value]->setPiece(new Pawn(Coord::E6->toArray(), PieceColor::WHITE->value));

        $board[Coord::A7->value]->setPiece(new Pawn(Coord::A7->toArray(), PieceColor::BLACK->value));
        $board[Coord::B7->value]->setPiece(new Pawn(Coord::B7->toArray(), PieceColor::BLACK->value));
        $board[Coord::C6->value]->setPiece(new Pawn(Coord::C6->toArray(), PieceColor::BLACK->value));
        $board[Coord::D5->value]->setPiece(new Pawn(Coord::D5->toArray(), PieceColor::BLACK->value));
        $board[Coord::G7->value]->setPiece(new Pawn(Coord::G7->toArray(), PieceColor::BLACK->value));

        /* Rooks */
        $board[Coord::G1->value]->setPiece(new Rook(Coord::G1->toArray(), PieceColor::WHITE->value));
        $board[Coord::H6->value]->setPiece(new Rook(Coord::H6->toArray(), PieceColor::WHITE->value));
        $board[Coord::E7->value]->setPiece(new Rook(Coord::E7->toArray(), PieceColor::BLACK->value));
        $board[Coord::A8->value]->setPiece(new Rook(Coord::A8->toArray(), PieceColor::BLACK->value));

        /* Knights */
        $board[Coord::F6->value]->setPiece(new Knight(Coord::F6->toArray(), PieceColor::WHITE->value));
        $board[Coord::H7->value]->setPiece(new Knight(Coord::H7->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::H8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    #[Test]
    public function test_if_king_is_not_in_checkmate_4(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::H8->value]->setPiece(new King(Coord::H8->toArray(), PieceColor::BLACK->value));
        $board[Coord::H1->value]->setPiece(new King(Coord::H1->toArray(), PieceColor::WHITE->value));

        /* Pawns */
        $board[Coord::A2->value]->setPiece(new Pawn(Coord::A2->toArray(), PieceColor::WHITE->value));
        $board[Coord::F2->value]->setPiece(new Pawn(Coord::F2->toArray(), PieceColor::WHITE->value));
        $board[Coord::H2->value]->setPiece(new Pawn(Coord::H2->toArray(), PieceColor::WHITE->value));
        $board[Coord::H3->value]->setPiece(new Pawn(Coord::H3->toArray(), PieceColor::WHITE->value));
        $board[Coord::E4->value]->setPiece(new Pawn(Coord::E4->toArray(), PieceColor::WHITE->value));

        $board[Coord::A7->value]->setPiece(new Pawn(Coord::A7->toArray(), PieceColor::BLACK->value));
        $board[Coord::B7->value]->setPiece(new Pawn(Coord::B7->toArray(), PieceColor::BLACK->value));
        $board[Coord::F7->value]->setPiece(new Pawn(Coord::F7->toArray(), PieceColor::BLACK->value));
        $board[Coord::H7->value]->setPiece(new Pawn(Coord::H7->toArray(), PieceColor::BLACK->value));
        $board[Coord::D6->value]->setPiece(new Pawn(Coord::D6->toArray(), PieceColor::BLACK->value));
        $board[Coord::D5->value]->setPiece(new Pawn(Coord::D5->toArray(), PieceColor::BLACK->value));

        /* Rooks */
        $board[Coord::G1->value]->setPiece(new Rook(Coord::G1->toArray(), PieceColor::WHITE->value));
        $board[Coord::C8->value]->setPiece(new Rook(Coord::C8->toArray(), PieceColor::BLACK->value));
        $board[Coord::F8->value]->setPiece(new Rook(Coord::F8->toArray(), PieceColor::BLACK->value));

        /* Knights */
        $board[Coord::E2->value]->setPiece(new Knight(Coord::E2->toArray(), PieceColor::WHITE->value));
        $board[Coord::C4->value]->setPiece(new Knight(Coord::C4->toArray(), PieceColor::BLACK->value));

        /* Bishops */
        $board[Coord::B2->value]->setPiece(new Bishop(Coord::B2->toArray(), PieceColor::WHITE->value));
        $board[Coord::B6->value]->setPiece(new Bishop(Coord::B6->toArray(), PieceColor::BLACK->value));

        /* Queen */
        $board[Coord::G5->value]->setPiece(new Queen(Coord::G5->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::H8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    #[Test]
    public function test_if_king_is_not_in_checkmate_5(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::F8->value]->setPiece(new King(Coord::F8->toArray(), PieceColor::BLACK->value));
        $board[Coord::C2->value]->setPiece(new King(Coord::C2->toArray(), PieceColor::WHITE->value));

        /* Rooks */
        $board[Coord::A8->value]->setPiece(new Rook(Coord::A8->toArray(), PieceColor::WHITE->value));
        $board[Coord::B7->value]->setPiece(new Rook(Coord::B7->toArray(), PieceColor::WHITE->value));

        /* Knight */
        $board[Coord::A1->value]->setPiece(new Rook(Coord::A1->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::F8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    public function test_if_king_is_not_in_checkmate_because_check_can_be_blocked_1(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::F8->value]->setPiece(new King(Coord::F8->toArray(), PieceColor::BLACK->value));
        $board[Coord::C2->value]->setPiece(new King(Coord::C2->toArray(), PieceColor::WHITE->value));

        /* Rooks */
        $board[Coord::A8->value]->setPiece(new Rook(Coord::A8->toArray(), PieceColor::WHITE->value));
        $board[Coord::B7->value]->setPiece(new Rook(Coord::B7->toArray(), PieceColor::WHITE->value));

        /* Knight */
        $board[Coord::F6->value]->setPiece(new Knight(Coord::F6->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::F8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    public function test_if_king_is_not_in_checkmate_because_check_can_be_blocked_2(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::E8->value]->setPiece(new King(Coord::E8->toArray(), PieceColor::BLACK->value));
        $board[Coord::C2->value]->setPiece(new King(Coord::C2->toArray(), PieceColor::WHITE->value));

        /* Rooks && Queens */
        $board[Coord::A8->value]->setPiece(new Queen(Coord::A8->toArray(), PieceColor::WHITE->value));
        $board[Coord::B7->value]->setPiece(new Rook(Coord::B7->toArray(), PieceColor::WHITE->value));

        /* Bishop */
        $board[Coord::A5->value]->setPiece(new Bishop(Coord::A5->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::E8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    public function test_if_king_is_not_in_checkmate_because_check_can_be_blocked_3(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::E8->value]->setPiece(new King(Coord::E8->toArray(), PieceColor::BLACK->value));
        $board[Coord::C2->value]->setPiece(new King(Coord::C2->toArray(), PieceColor::WHITE->value));

        /* Pawns */
        $board[Coord::B6->value]->setPiece(new Pawn(Coord::B6->toArray(), PieceColor::BLACK->value));

        /* Rooks && Queens */
        $board[Coord::A8->value]->setPiece(new Queen(Coord::A8->toArray(), PieceColor::WHITE->value));
        $board[Coord::B7->value]->setPiece(new Rook(Coord::B7->toArray(), PieceColor::WHITE->value));

        /* Bishop */
        $board[Coord::A5->value]->setPiece(new Bishop(Coord::A5->toArray(), PieceColor::BLACK->value));
        $board[Coord::H4->value]->setPiece(new Bishop(Coord::H4->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::E8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }

    public function test_if_king_is_not_in_checkmate_because_check_can_be_blocked_4(): void
    {
        // given
        $game = new Game();
        $game->getBoard()->removeAllPiecesFromTheBoard();

        // and given
        $board = $game->getBoard()->getBoardInStringNotation();

        // and given
        $board[Coord::E8->value]->setPiece(new King(Coord::E8->toArray(), PieceColor::BLACK->value));
        $board[Coord::C2->value]->setPiece(new King(Coord::C2->toArray(), PieceColor::WHITE->value));

        /* Pawns */
        $board[Coord::B6->value]->setPiece(new Pawn(Coord::B6->toArray(), PieceColor::BLACK->value));

        /* Rooks && Queens */
        $board[Coord::A8->value]->setPiece(new Queen(Coord::A8->toArray(), PieceColor::WHITE->value));
        $board[Coord::G8->value]->setPiece(new Queen(Coord::G8->toArray(), PieceColor::WHITE->value));

        $board[Coord::B7->value]->setPiece(new Rook(Coord::B7->toArray(), PieceColor::WHITE->value));
        $board[Coord::D8->value]->setPiece(new Rook(Coord::D8->toArray(), PieceColor::BLACK->value));
        $board[Coord::F1->value]->setPiece(new Rook(Coord::F1->toArray(), PieceColor::BLACK->value));

        /* Bishop */
        $board[Coord::A5->value]->setPiece(new Bishop(Coord::A5->toArray(), PieceColor::BLACK->value));
        $board[Coord::H4->value]->setPiece(new Bishop(Coord::H4->toArray(), PieceColor::BLACK->value));

        // when
        /** @var King $blackKing */
        $blackKing = $board[Coord::E8->value]->getPiece();
        $result = $blackKing->checkIfKingIsInCheckmate($game);

        // then
        self::assertFalse($result);
    }
}
