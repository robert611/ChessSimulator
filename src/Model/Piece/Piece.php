<?php 

namespace App\Model\Piece;

abstract class Piece 
{
    private string $name;

    private string $picture;
    
    private array $cord;
    
    private string $side;
    
    abstract function move(array $board);

    abstract function getPossibleMoves(array $board): array;

    abstract function isProtectingGivenSquare(array $board, array $squareToProtect): bool;

    abstract function getPicture(): string;

    abstract function setPicture(string $picture): self;

    abstract function getSide(): string;

    abstract function setSide(string $side): self;

    abstract function getCords(): array;

    abstract function setCords(array $cords): self;

    abstract function getName(): string;

    abstract function setName(string $name): self;

    protected function checkIfCoordinatesAreInsideOfBoard($horizontal, $vertical): bool
	{
		if (($vertical > 8 or $horizontal > 8) or ($vertical < 1 or $horizontal < 1)) return false;
		
		return true;
    }
}