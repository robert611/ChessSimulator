<?php 

namespace App\Model;

class BoardSquare 
{
    private array $cords;
    public ?object $piece;
    private string $color;

    public function __construct(array $cords, ?object $piece, string $color)
    {
        $this->cords = $cords;
        $this->piece = $piece;
        $this->color = $color;
    }

    public function __clone()
    {
        if (is_object($this->piece)) $this->piece = clone $this->piece;
    }
    
    /**
     * Get the value of cords
     */ 
    public function getCords()
    {
        return $this->cords;
    }

    /**
     * Set the value of piece
     *
     * @return  self
     */ 
    public function setPiece(?object $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    /**
     * Get the value of piece
     */ 
    public function getPiece(): ?object
    {
        return $this->piece;
    }

    /**
     * Get the value of color
     */ 
    public function getColor(): ?string
    {
        return $this->color;
    }
}