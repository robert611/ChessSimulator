<?php 

declare(strict_types=1);

namespace App\Model\OpeningModule;

use App\Model\OpeningModule\Openings\EnglishOpening;
use App\Model\OpeningModule\Openings\OpeningInterface;

class MatchOpening
{
    /**
     * This method returns opening tree nodes matching already played moves, starting from moves
     * that can be played next.
     *
     * @return TreeNode[]|null
     */
    public function getMatchingOpeningsNodes(array $moves): ?array
    {
        if (count($moves) === 0) {
            return null;
        }

        /* Get moves in format: [['from_cords'], ['to_cords']] */
        $moves = $this->getMovesCords($moves);

        $matchingOpeningsNodes = [];

        $openings = $this->getOpenings();

        foreach ($openings as $opening) {
            $matchingNode = $this->traverseOpeningTreeAndCompareMoves($opening->getOpeningTree()->getRoot(), $moves);

            if (is_array($matchingNode)) {
                $matchingOpeningsNodes = array_merge($matchingNode, $matchingOpeningsNodes);
            }
        }

        return $matchingOpeningsNodes;
    }

    /**
     * @param TreeNode[] $matchingOpeningsNodes
     */
    public function getNextMoveForGivenOpenings(array $matchingOpeningsNodes): array 
    {
        $potentialMoves = $this->getPositionPotentialMoves($matchingOpeningsNodes);

        return $potentialMoves[array_rand($potentialMoves)];
    }

    /**
     * @param TreeNode[] $matchingOpeningsNodes
     */
    public function getPositionPotentialMoves(array $matchingOpeningsNodes): array
    {
        $potentialMoves = [];

        foreach ($matchingOpeningsNodes as $node) {
            $potentialMoves[] = $node->getData();
        }

        return $potentialMoves;
    }

    private function traverseOpeningTreeAndCompareMoves(
        TreeNode $openingNode,
        array $moves,
        int $iteration = 1,
    ): ?array {
        if ($iteration === 1) {
            if ($openingNode->getData() === $moves[$iteration - 1]) {
                return $this->traverseOpeningTreeAndCompareMoves($openingNode, $moves, $iteration + 1);
            }

            return null;
        }

        $nodeChildren = $openingNode->getChildren();

        foreach ($nodeChildren as $child) {
            if ($child->getData() === $moves[$iteration - 1]) {
                // If it is the last played move, then return node children as the next possible moves,
                // and if not look further into opening theory
                if (count($moves) === $iteration) {
                    return $child->hasChildren() ? $child->getChildren(): null;
                }

                return $this->traverseOpeningTreeAndCompareMoves($child, $moves, $iteration + 1);
            }
        }
        
        return null;
    }

    public function getMovesCords(array $moves): array
    {
        return array_map(function ($move) {
            return [$move['previous_cords'], $move['new_cords_square']->getCords()];
        }, $moves);
    }

    /**
     * @return OpeningInterface[]
     */
    public function getOpenings(): array
    {
        $openings = [];

        $openings['english'] = new EnglishOpening();

        return $openings;
    }
}
