<?php

declare(strict_types=1);

namespace App\Model\OpeningModule;

class TreeNode
{
    public ?array $data = NULL;
    public array $children = [];

    public function __construct(?array $data = NULL)
    {
        $this->data = $data;
    }

    public function addChildren(TreeNode $node): void
    {
        $this->children[] = $node;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @return TreeNode[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }
}
