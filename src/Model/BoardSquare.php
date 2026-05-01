<?php 

declare(strict_types=1);

namespace App\Model;

use App\Dictionary\PieceColor;
use App\Model\Piece\Piece;

class BoardSquare
{
    public function __construct(
        private readonly array $cords,
        private readonly PieceColor $color,
        private ?Piece $piece = null,
    ) {
    }

    public function getCords(): array
    {
        return $this->cords;
    }

    public function getColor(): string
    {
        return $this->color->value;
    }

    public function setPiece(?Piece $piece): void
    {
        $this->piece = $piece;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function __clone(): void
    {
        if (is_object($this->piece)) {
            $this->piece = clone $this->piece;
        }
    }
}
