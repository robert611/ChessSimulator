<?php 

namespace App\Model;

use App\Model\Board;
use App\Model\Piece\Bishop;
use App\Model\Piece\King;
use App\Model\Piece\Pawn;
use App\Model\Piece\Quenn;
use App\Model\Piece\Rook;
use App\Model\Piece\Knight;

class Game 
{
	private array $board;
	
	private array $moves;

	private array $positions;

	private array $result;

	public function __construct()
	{
		$this->moves = [];
		$this->positions = [];
		$this->result = ['result' => '', 'type' => ''];
		$this->board = (new Board())->getBoard();
	}

	public function makeMove(object $piece, array $cords): void
	{
		/* ['default', 'capture', 'check', 'check_with_capture'] */
		$type = 'default';

		/* Remove moving piece from square from which piece moved */
		$this->getBoard()[$piece->getCords()[0]][$piece->getCords()[1]]->setPiece(null);

		/* Get piece which was on that square before */
		$squareToWhichMoveIsMade = $this->getBoard()[$cords[0]][$cords[1]];
		$pieceOnSquareToWhichMoveIsMade = $squareToWhichMoveIsMade->getPiece();

		/* Make sure that new_cords_square index will have state of the square before that move was made */
		$cloneOfSquareWithNewCords = clone $squareToWhichMoveIsMade;

		$piecePreviousCords = $piece->getCords();

		/* Check if pawn should be promoted after that move, for now it will promote to quenn as a default */
		if ($piece instanceof Pawn && (($piece->getSide() == 'white' && $cords[0] == 8) or ($piece->getSide() == 'black' && $cords[0] == 1))) {
			$newPiece = new Quenn($piece->getId(), $cords, $piece->getSide());
			$promotion = true;

			$this->getBoard()[$cords[0]][$cords[1]]->setPiece($newPiece);
		} else {
			/* Assign piece to a square to which piece moved */
			$this->getBoard()[$cords[0]][$cords[1]]->setPiece($piece);
		}

		$piece->setCords($cords);

		/* Determine type of this move */
		$opponentKingColor = $piece->getSide() == 'white' ? 'black' : 'white';
		$opponentKing = $this->getPieceSquare('king', $opponentKingColor)->getPiece();

		$isOpponentKingInCheck = $opponentKing->checkIfKingIsInCheck($this);

		if (is_null($pieceOnSquareToWhichMoveIsMade)) {
			if ($isOpponentKingInCheck && isset($promotion)) {
				$type = 'promotion_with_check';
			} else if(isset($promotion)) {
				$type = 'promotion';
			}
			else if ($isOpponentKingInCheck) {
				$type = 'check';
			}
		}
		else {
			if ($isOpponentKingInCheck && isset($promotion)) {
				$type = 'promotion_with_capture_and_check';
			} else if ($isOpponentKingInCheck) {
				$type = 'check_with_capture';
			} else if (isset($promotion)) {
				$type = 'promotion_with_capture';
			}
			else {
				$type = 'capture';
			}
		}

		$this->moves[] = ['piece' => $piece, 'previous_cords' => $piecePreviousCords, 'new_cords_square' => $cloneOfSquareWithNewCords, 'type' => $type];

		$this->addNewPosition();
	}

	public function playGame(int $moves = 10000)
	{
		$whiteKing = $this->getPieceSquare('king', 'white')->getPiece();
		$blackKing = $this->getPieceSquare('king', 'black')->getPiece();

		$movingSide = 'white';

		$iteration = 1;

		do {
			/* Every piece has access to that method from abstract class piece */
			$sidePiecesWithPossibleMoves = $this->getGivenSidePiecesWithPossibleMoves($movingSide);

			do {
				$movingPiece = $sidePiecesWithPossibleMoves[array_rand($sidePiecesWithPossibleMoves)];

				$move = null;
	
				if (!empty($movingPiece['possible_moves'])) {
					$move = $movingPiece['possible_moves'][array_rand($movingPiece['possible_moves'])];
				}
			}
			while (is_null($move));
			
			$this->makeMove($movingPiece['piece'], $move);

			/* If white then black, and if black then white */
			$movingSide = $movingSide == 'white' ? 'black' : 'white';

			$iteration++;
		} while(!$whiteKing->checkIfKingIsInCheckmate($this) && !$blackKing->checkIfKingIsInCheckmate($this) && !$this->checkIfGameIsDrawn() && $iteration <= $moves);

		if ($whiteKing->checkIfKingIsInCheckmate($this))
		{
			$this->result = ['result' => 'black_win', 'type' => 'checkmate'];
		}
		else if ($blackKing->checkIfKingIsInCheckmate($this))
		{
			$this->result = ['result' => 'white_win', 'type' => 'checkmate'];
		}
	}

	/* Note that only kings, queens and bishops can be recognized */
	public function getPieceSquare($name, $side, $squareColor = null): ?object
	{
		foreach ($this->getBoard() as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
				/* First compare name of piece */
				if (is_object($square->getPiece()) && $square->getPiece()->getName() == $name)
				{
					/* Secondly compare piece's side */
					if ($square->getPiece()->getSide() == $side) {

						/* If it is a bishop then square color is important */
						if (!is_null($squareColor) && $square->getColor() == $squareColor)
						{
							return $square;
						}
						else 
						{
							return $square; 
						}
					}
				}
			}
		}
		
		return null;
	}

	public function checkIfGameIsDrawn(): bool
	{
		/* Three Hold repetition of a position not necesserly moves */
		/* Insufficient material */
		/*
			a - There are two kings 
			b - King + one or more bishops OF THE SAME COLOR against king
			c - King + Knight againts King 
			d - King + one or more bishops of the same color against king + bishop or bishop of the same color as other side
		*/
		/* Stalemate, also including dead positions like one in which there are 6 pawns 3 white and 3 black, but neither king can ever capture one */
		/* 50 moves rule, If in last 50 moves none of the players did not capture anything or did not move pawn then it is a draw */

		/* First Insufficient material */
		$squaresWithPiecesOnTheBoard = $this->getAllSquaresOfThePiecesOnTheBoard();

		$squares = array_merge($squaresWithPiecesOnTheBoard['white'], $squaresWithPiecesOnTheBoard['black']);
		
		/* In this case there are only two pieces left */
		if (count($squares) == 2) {
			$this->result = ['result' => 'draw', 'type' => 'insufficient_material'];
			return true;
		}

		/* In this case there 3 or 4 pieces but one side has only one bishop or knight */
		if (count($squares) <= 4) {

			$insufficientMaterial = true;
			$knights = 0;
			$bishopsSquares = array();

			foreach ($squares as $square) {
				$piece = $square->getPiece();

				if ($piece instanceof Knight) 
				{
					$knights++;
				}
				if ($piece instanceof Bishop) {
					$bishopsSquares[] = $square;
				}
				else if (($piece instanceof Rook) or ($piece instanceof Pawn) or ($piece instanceof Quenn)) {
					$insufficientMaterial = false;
					break;
				} 
			}

			/* If there are only three pieces first part of the check will always be true, it's enough that none of them is rook, pawn or quenn to a draw so insufficientMaterial must be equal to true */
			/* If none of the pieces is rook, pawn or quenn and one side has only one piece without counting king it's draw, unless each side has one knight or each side has one bishop of diffrent color then opponent, then it is not a draw */
			if ($knights !== 2 && !(count($bishopsSquares) == 2 && ($bishopsSquares[0]->getColor() != $bishopsSquares[1]->getColor())))
			{
				if ((count($squaresWithPiecesOnTheBoard['white']) < 3 && count($squaresWithPiecesOnTheBoard['black']) < 3) && $insufficientMaterial == true)
				{
					$this->result = ['result' => 'draw', 'type' => 'insufficient_material'];
					return true;
				}
			} 

			/* Even if one side has two bishops they must be of diffrent color in order for it not to be a draw, it is checked later */
		}

		/* Case in which one or both sides have two or more bishop of exactly the same type */
		$oneSideHasBishopsOfTheSameColor['black'] = ['is_true' => null, 'color' => null];
		$oneSideHasBishopsOfTheSameColor['white'] = ['is_true' => null, 'color' => null];

		$oneOfThePiecesIsNotBishopOrKing = false;

		foreach ($squaresWithPiecesOnTheBoard as $key => $side)
		{
			$bishopsSquares = array();

			foreach ($side as $square)
			{
				if ($square->getPiece() instanceof Bishop)
				{
					$bishopsSquares[] = $square;
				}
				else if (!$square->getPiece() instanceof King)
				{
					$oneOfThePiecesIsNotBishopOrKing = true;
					continue; /* In this case one of the pieces is not bishop or king and there are more than 4 pieces on the board, so not a draw */
				}
			}

			$bishopsColor = null;

			/* Notice in this case there must be at least 5 pieces on the board and these pieces can be only bishops ans kings */
			foreach ($bishopsSquares as $bishopsSquare)
			{
				if (is_null($bishopsColor))
				{
					$bishopsColor = $bishopsSquare->getColor();
					continue;
				}

				/* In this case this side has two bishops of diffrent color, not a draw */
				if ($bishopsSquare->getColor() !== $bishopsColor)
				{
					$oneSideHasBishopsOfTheSameColor[$key]['is_true'] = false;
					break;
				}
			}
			if (count($bishopsSquares) == 0)
			{
				$oneSideHasBishopsOfTheSameColor[$key]['is_true'] = true;

				$oneSideHasBishopsOfTheSameColor[$key]['color'] = 'correct';
			} 
			else if (is_null($oneSideHasBishopsOfTheSameColor[$key]['is_true']))
			{
				$oneSideHasBishopsOfTheSameColor[$key]['is_true'] = true;

				$oneSideHasBishopsOfTheSameColor[$key]['color'] = $bishopsSquares[0]->getColor();
			}
		}

		/* It means that both sides have bishops all of the same color or one side have none at all, but the second has bishops only of one color  */
		if (!$oneOfThePiecesIsNotBishopOrKing && ($oneSideHasBishopsOfTheSameColor['white']['is_true'] == true && $oneSideHasBishopsOfTheSameColor['black']['is_true'] == true)
		&& ($oneSideHasBishopsOfTheSameColor['white']['color'] == $oneSideHasBishopsOfTheSameColor['black']['color'] 
		or ($oneSideHasBishopsOfTheSameColor['white']['color'] == 'correct' or $oneSideHasBishopsOfTheSameColor['black']['color'] == 'correct')))
		{
			$this->result = ['result' => 'draw', 'type' => 'insufficient_material'];
			return true;
		}

		/* 50 moves rule, If in last 50 moves none of the players did not capture anything or did not move pawn then it is a draw */
		$numberOfMovesPlayed = count($this->moves);

		if ($numberOfMovesPlayed >= 50) {
			$lastMove = $numberOfMovesPlayed - 1;

			$fiftyMovesRuleApplies = true;

			for($i = 0; $i <= 49; $i++)
			{
				$moveType = $this->moves[$lastMove - $i]['type'];
				$piece = $this->moves[$lastMove - $i]['piece'];

				if ($moveType == 'capture' or $moveType == 'check_with_capture' or $piece instanceof Pawn)
				{
					$fiftyMovesRuleApplies = false;
					break;
				} 
			}

			if ($fiftyMovesRuleApplies) {
				$this->result = ['result' => 'draw', 'type' => 'fifty_moves_rule'];
				return true;
			}
		}
		
		/* Stalemate */
		if ($numberOfMovesPlayed > 0)
		{
			$sideToMove = $this->moves[$numberOfMovesPlayed - 1]['piece']->getSide() == 'black' ? 'white' : 'black';
		
			$sidePossibleMoves = $this->getGivenSidePossibleMoves($sideToMove);
	
			if (count($sidePossibleMoves) == 0) {
				$this->result = ['result' => 'draw', 'type' => 'stalemate'];
				return true;
			}	
		}
		
		/* Three hold repetition */
		foreach ($this->positions as $exisitingPosition) 
		{
			if ($exisitingPosition['occurance'] == 3)
			{
				$this->result = ['result' => 'draw', 'type' => 'three_hold_repetition'];
				return true;
			}
		}

		return false;		
	}

	public function getAllSquaresOfThePiecesOnTheBoard(): array
	{
 		$board = $this->getBoard();

        $squaresWithPieces['white'] = array();
        $squaresWithPieces['black'] = array();

        foreach ($board as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
                $pieceOnSquare = $square->getPiece();

				/* If there is as piece on that square */
				if (is_object($pieceOnSquare)) {
                    $pieces[$pieceOnSquare->getSide()][] = $square;
				}
			}
        }
        
        return $pieces;
	}

	private function addNewPosition() 
	{
		$repeatedPosition = false;
        $position = array();

        foreach ($this->board as $horizontalColumn) {
            foreach ($horizontalColumn as $square) {
                $squareCords = $square->getCords();

                $position[$squareCords[0]][$squareCords[1]] = is_null($square->getPiece()) ? null : get_class($square->getPiece()) . "\\". $square->getPiece()->getId();
            }
		}
		
		/* If there was already such position in this game, then do not create new array, rather increase occurance value in already existing position array */
		foreach ($this->positions as &$exisitingPosition) 
		{
			if ($exisitingPosition['position'] == $position)
			{
				$repeatedPosition = true;
				$exisitingPosition['occurance'] = $exisitingPosition['occurance'] + 1;
			}
		}

        if (!$repeatedPosition) $this->positions[] = ['occurance' => 1, 'position' => $position];
    }
	
	public function getGivenSidePiecesWithPossibleMoves(string $side): array
    {
        $board = $this->getBoard();

        $squaresAttackedByGivenSide = array();

        foreach ($board as $horizontalColumn) {
			foreach ($horizontalColumn as $square)
			{
                $pieceOnSquare = $square->getPiece();

				/* If there is as piece on that square */
				if (is_object($pieceOnSquare) && $pieceOnSquare->getSide() == $side) {
                    $squaresAttackedByGivenSide[] = ['piece' => $pieceOnSquare, 'possible_moves' => $pieceOnSquare->getPossibleMoves($this)];
				}
			}
        }
        
        return $squaresAttackedByGivenSide;
    }

    public function getPiecesAttackingGivenSquare(BoardSquare $square, string $side)
    {
        $piecesAttackingGivenSquare = array();

        $squaresAttackedByGivenSidePieces = $this->getGivenSidePiecesWithPossibleMoves($side);

        foreach ($squaresAttackedByGivenSidePieces as $piece) {
            if (in_array($square->getCords(), $piece['possible_moves'])) {
                $piecesAttackingGivenSquare[] = $piece['piece'];
            }
        }

		return $piecesAttackingGivenSquare;
	}
	
	public function getGivenSidePossibleMoves(string $side): array
    {
        $squaresAttackedByGivenSidePieces = $this->getGivenSidePiecesWithPossibleMoves($side);

        $possibleMoves = array();

        foreach ($squaresAttackedByGivenSidePieces as $piece) {
            $possibleMoves = array_merge($possibleMoves, $piece['possible_moves']);
        }

        return $possibleMoves;
	}

	public function getPieceMoves(string $pieceId): array
	{
		$pieceMoves = array();

		foreach ($this->moves as $move)
		{
			if ($move['piece']->getId() == $pieceId) $pieceMoves[] = $move;
		}

		return $pieceMoves;
	}

	/**
	 * Get the value of moves
	 */ 
	public function getMoves()
	{
		return $this->moves;
	}

	/**
	 * Get the value of board
	 */ 
	public function getBoard(): array
	{
		return $this->board;
	}

	/**
	 * Set the value of board
	 *
	 * @return  self
	 */ 
	public function setBoard(array $board): self
	{
		$this->board = $board;

		return $this;
	}

	/**
	 * Get the value of positions
	 */ 
	public function getPositions()
	{
		return $this->positions;
	}

	/**
	 * Set the value of positions
	 *
	 * @return  self
	 */ 
	public function setPositions($positions)
	{
		$this->positions = $positions;

		return $this;
	}

	/**
	 * Get the value of result
	 */ 
	public function getResult()
	{
		return $this->result;
	}
}