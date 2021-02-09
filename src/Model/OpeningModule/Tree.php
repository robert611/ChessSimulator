<?php 

namespace App\Model\OpeningModule;

class Tree
{
    public $root = NULL;

    public function __construct(TreeNode $node) {
        $this->root = $node;
    }

    public function getRoot()
    {
        return $this->root;
    }
}