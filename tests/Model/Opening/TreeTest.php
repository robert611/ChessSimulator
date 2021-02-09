<?php 

namespace App\Tests\Model;

use App\Model\Board;
use App\Model\Game;
use PHPUnit\Framework\TestCase;
use App\Model\OpeningModule\Tree;
use App\Model\OpeningModule\TreeNode;

class TreeTest extends TestCase
{
    public function testTree()
    {
        $whiteC4 = new TreeNode([[2, 3], [4, 3]]);
        $blackE5 = new TreeNode([[7, 5], [5, 5]]);

        $whiteC4->addChildren($blackE5);

        $tree = new Tree($whiteC4);

        $this->assertTrue($whiteC4->getChildren()[0]->getData() == [[7, 5], [5, 5]]);
        $this->assertTrue($tree->getRoot()->getData() == [[2, 3], [4, 3]]);
    }
}