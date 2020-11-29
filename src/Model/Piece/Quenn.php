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

	public function getPossibleMoves(array $board): array
	{
		$possibleMoves = [];

		return $possibleMoves;
	}

	public function isProtectingGivenSquare(array $board, array $squareToProtect): bool
	{
		return true;
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