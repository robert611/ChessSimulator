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

    public function testIfKingIsNotInCheckmate(): void
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][2]->setPiece(new King('SOPEDF', [8, 2], 'black'));
        $game->getBoard()[6][2]->setPiece(new King('SOPEDF', [6, 2], 'white'));

        $game->getBoard()[8][3]->setPiece(new Queen('SOPEDF', [8, 3], 'white'));
        $game->getBoard()[7][2]->setPiece(new Pawn('SOPEDF', [7, 2], 'black'));
        
        $wrongSet[0]['king'] = $game->getBoard()[8][2]->getPiece();
        $wrongSet[0]['game'] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[6][5]->setPiece(new King('SOPEDF', [6, 5], 'white'));

        $game->getBoard()[6][4]->setPiece(new Queen('SOPEDF', [6, 4], 'white'));
        
        $wrongSet[1]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[1]['game'] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][8]->setPiece(new King('SOPEDF', [8, 8], 'black'));
        $game->getBoard()[2][4]->setPiece(new King('SOPEDF', [2, 4], 'white'));

        /* Pawns */
        $game->getBoard()[2][1]->setPiece(new Pawn('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[2][2]->setPiece(new Pawn('SOPEDF', [2, 2], 'white'));
        $game->getBoard()[2][3]->setPiece(new Pawn('SOPEDF', [2, 3], 'white'));
        $game->getBoard()[5][6]->setPiece(new Pawn('SOPEDF', [5, 6], 'white'));
        $game->getBoard()[6][5]->setPiece(new Pawn('SOPEDF', [6, 5], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'black'));
        $game->getBoard()[7][2]->setPiece(new Pawn('SOPEDF', [7, 2], 'black'));
        $game->getBoard()[6][3]->setPiece(new Pawn('SOPEDF', [6, 3], 'black'));
        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));
        $game->getBoard()[7][7]->setPiece(new Pawn('SOPEDF', [7, 7], 'black'));

        /* Rooks */
        $game->getBoard()[1][7]->setPiece(new Rook('SOPEDF', [1, 7], 'white'));
        $game->getBoard()[6][8]->setPiece(new Rook('SOPEDF', [6, 8], 'white'));
        $game->getBoard()[7][5]->setPiece(new Rook('SOPEDF', [7, 5], 'black'));
        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'black'));
        
        /* Knights */
        $game->getBoard()[6][6]->setPiece(new Knight('SOPEDF', [6, 6], 'white'));
        $game->getBoard()[7][8]->setPiece(new Knight('SOPEDF', [7, 8], 'black'));

        $wrongSet[2]['king'] = $game->getBoard()[8][8]->getPiece();
        $wrongSet[2]['game'] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        $game->getBoard()[8][7]->setPiece(new King('SOPEDF', [8, 7], 'black'));
        $game->getBoard()[1][8]->setPiece(new King('SOPEDF', [1, 8], 'white'));

        /* Pawns */
        $game->getBoard()[2][1]->setPiece(new Pawn('SOPEDF', [2, 1], 'white'));
        $game->getBoard()[2][6]->setPiece(new Pawn('SOPEDF', [2, 6], 'white'));
        $game->getBoard()[2][8]->setPiece(new Pawn('SOPEDF', [2, 8], 'white'));
        $game->getBoard()[3][6]->setPiece(new Pawn('SOPEDF', [3, 6], 'white'));
        $game->getBoard()[4][5]->setPiece(new Pawn('SOPEDF', [4, 5], 'white'));

        $game->getBoard()[7][1]->setPiece(new Pawn('SOPEDF', [7, 1], 'black'));
        $game->getBoard()[7][2]->setPiece(new Pawn('SOPEDF', [7, 2], 'black'));
        $game->getBoard()[7][6]->setPiece(new Pawn('SOPEDF', [7, 6], 'black'));
        $game->getBoard()[7][8]->setPiece(new Pawn('SOPEDF', [7, 8], 'black'));
        $game->getBoard()[6][4]->setPiece(new Pawn('SOPEDF', [6, 4], 'black'));
        $game->getBoard()[5][4]->setPiece(new Pawn('SOPEDF', [5, 4], 'black'));

        /* Rooks */
        $game->getBoard()[1][7]->setPiece(new Rook('SOPEDF', [1, 7], 'white'));
        $game->getBoard()[8][3]->setPiece(new Rook('SOPEDF', [8, 3], 'black'));
        $game->getBoard()[8][6]->setPiece(new Rook('SOPEDF', [8, 6], 'black'));
        
        /* Knights */
        $game->getBoard()[2][5]->setPiece(new Knight('SOPEDF', [2, 5], 'white'));
        $game->getBoard()[4][3]->setPiece(new Knight('SOPEDF', [4, 3], 'black'));
        
        /* Bishops */
        $game->getBoard()[2][2]->setPiece(new Bishop('SOPEDF', [2, 2], 'white'));
        $game->getBoard()[4][4]->setPiece(new Bishop('SOPEDF', [4, 4], 'white'));
        $game->getBoard()[6][2]->setPiece(new Bishop('SOPEDF', [6, 2], 'black'));

        /* Queen */
        $game->getBoard()[5][7]->setPiece(new Queen('SOPEDF', [5, 7], 'black'));

        $wrongSet[3]['king'] = $game->getBoard()[8][7]->getPiece();
        $wrongSet[3]['game'] = $game;

        /* Position 5 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Rooks */
        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Knight */
        $game->getBoard()[1][1]->setPiece(new Rook('SOPEDF', [1, 1], 'black'));

        $wrongSet[4]['king'] = $game->getBoard()[8][6]->getPiece();
        $wrongSet[4]['game'] = $game;

        foreach ($wrongSet as $position)
        {
            $isInCheckmate = $position['king']->checkIfKingIsInCheckmate($position['game']);
            $this->assertFalse($isInCheckmate);
        }
    }

    public function checkIfKingIsNotInCheckmateBecauseCheckCanBeBlocked(): void
    {
        /* Position 1 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][6]->setPiece(new King('SOPEDF', [8, 6], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Rooks */
        $game->getBoard()[8][1]->setPiece(new Rook('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Knight */
        $game->getBoard()[6][6]->setPiece(new Knight('SOPEDF', [6, 6], 'black'));

        $wrongSet[0]['king'] = $game->getBoard()[8][6]->getPiece();
        $wrongSet[0]['game'] = $game;

        /* Position 2 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Rooks && Queens */
        $game->getBoard()[8][1]->setPiece(new Queen('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Bishop */
        $game->getBoard()[5][1]->setPiece(new Bishop('SOPEDF', [5, 1], 'black'));

        $wrongSet[1]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[1]['game'] = $game;

        /* Position 3 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Pawns */
        $game->getBoard()[6][2]->setPiece(new Pawn('SOPEDF', [6, 2], 'black'));


        /* Rooks && Queens */
        $game->getBoard()[8][1]->setPiece(new Queen('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));

        /* Bishop */
        $game->getBoard()[5][1]->setPiece(new Bishop('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[4][8]->setPiece(new Bishop('SOPEDF', [4, 8], 'black'));
 
        $wrongSet[2]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[2]['game'] = $game;

        /* Position 4 */
        $game = new Game();

        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $game->getBoard()[$i][$j]->setPiece(null);
            }
        }

        /* Kings */
        $game->getBoard()[8][5]->setPiece(new King('SOPEDF', [8, 5], 'black'));
        $game->getBoard()[2][3]->setPiece(new King('SOPEDF', [2, 3], 'white'));

        /* Pawns */
        $game->getBoard()[6][2]->setPiece(new Pawn('SOPEDF', [6, 2], 'black'));


        /* Rooks && Queens */
        $game->getBoard()[8][1]->setPiece(new Queen('SOPEDF', [8, 1], 'white'));
        $game->getBoard()[8][7]->setPiece(new Queen('SOPEDF', [8, 7], 'white'));

        $game->getBoard()[7][2]->setPiece(new Rook('SOPEDF', [7, 2], 'white'));
        $game->getBoard()[8][4]->setPiece(new Rook('SOPEDF', [8, 4], 'black'));
        $game->getBoard()[1][6]->setPiece(new Rook('SOPEDF', [1, 6], 'black'));

        /* Bishop */
        $game->getBoard()[5][1]->setPiece(new Bishop('SOPEDF', [5, 1], 'black'));
        $game->getBoard()[4][8]->setPiece(new Bishop('SOPEDF', [4, 8], 'black'));
 
        $wrongSet[3]['king'] = $game->getBoard()[8][5]->getPiece();
        $wrongSet[3]['game'] = $game;

        foreach ($wrongSet as $position)
        {
            $isInCheckmate = $position['king']->checkIfKingIsInCheckmate($position['game']);
            $this->assertFalse($isInCheckmate);
        }
    }
}
