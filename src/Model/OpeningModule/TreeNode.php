<?php 

namespace App\Model\OpeningModule;

class TreeNode
{
    public $data = NULL;
    public $children = [];

    public function __construct(array $data = NULL)
    {
        $this->data = $data;
    }

    public function addChildren(TreeNode $node) 
    {
        $this->children[] = $node;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function getChildren(): array
    {
        return $this->children;
    }
}