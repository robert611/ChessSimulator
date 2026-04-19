<?php 

declare(strict_types=1);

namespace App\Tests\Model\Opening;

use PHPUnit\Framework\TestCase;
use App\Model\OpeningModule\Tree;
use App\Model\OpeningModule\TreeNode;

class TreeTest extends TestCase
{
    public function testTree(): void
    {
        // given
        $whiteC4 = new TreeNode([[2, 3], [4, 3]]);
        $blackE5 = new TreeNode([[7, 5], [5, 5]]);
        $whiteC4->addChildren($blackE5);

        // when
        $tree = new Tree($whiteC4);

        // then
        self::assertSame([[7, 5], [5, 5]], $whiteC4->getChildren()[0]->getData());
        self::assertSame([[2, 3], [4, 3]], $tree->getRoot()->getData());
    }
}
