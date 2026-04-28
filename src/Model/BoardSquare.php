<?php 

declare(strict_types=1);

namespace App\Model;

use App\Model\Piece\Piece;

class BoardSquare
{
    private array $cords;
    public ?Piece $piece;
    private string $color;

    public function __construct(array $cords, ?Piece $piece, string $color)
    {
        $this->cords = $cords;
        $this->piece = $piece;
        $this->color = $color;
    }

    public function __clone()
    {
        if (is_object($this->piece)) {
            $this->piece = clone $this->piece;
        }
    }

    public function getCords(): array
    {
        return $this->cords;
    }

    public function setPiece(?Piece $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }
}
