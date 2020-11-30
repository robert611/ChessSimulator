<?php

namespace App\Model\Piece;

class Quenn extends Piece
{
	private string $name = 'quenn';
	private string $picture;
	private array $cord;
	private string $side;

	public function __construct($cord, $side)
	{
		$this->cord = $cord;
		$this->side = $side;
	}

	public function move(array $board)
	{
		$possibleMoves = $this->getPossibleMoves($board);

		return $possibleMoves;
	}

	public function findOutPossibleMovesAndProtectedSquares(array $board): array
	{
		$possibleMoves = [];

		$protectedSquares = [];

		/* $protectedSquares on its own contains only squares on which our pieces are, $possibleMoves contains all of the other moves like empty squares or oponnent pieces */
		return ['possible_moves' => $possibleMoves, 'protected_squares' => array_merge($possibleMoves, $protectedSquares)];
	}

	public function getPicture(): string
	{
		return $this->side . "-" . $this->name . ".png";
	}

	public function setPicture(string $picture): self
	{
		$this->picture = $picture;

		return $this;
	}

	public function getSide(): string
	{
		return $this->side;
	}

	public function setSide(string $side): self
	{
		$this->side = $side;

		return $this;
	}
 
	public function getCords(): array
	{
		return $this->cords;
	}
 
	public function setCords(array $cords): self
	{
		$this->cords = $cords;

		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}
}