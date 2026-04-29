<?php 

declare(strict_types=1);

namespace App\Model\OpeningModule;

class Tree
{
    public ?TreeNode $root = NULL;

    public function __construct(TreeNode $node)
    {
        $this->root = $node;
    }

    public function getRoot(): ?TreeNode
    {
        return $this->root;
    }
}
