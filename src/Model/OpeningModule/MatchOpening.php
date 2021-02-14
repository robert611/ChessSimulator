<?php 

namespace App\Model\OpeningModule;

use App\Model\OpeningModule\Openings\English;
use App\Model\OpeningModule\TreeNode;

class MatchOpening 
{
    private array $openings;

    public function __construct()
    {
        $this->fillOpeningsArray();
    }

    public function getMatchingOpeningsNodes(array $moves): ?array
    {
        if (count($moves) == 0) return null;

        /* Get moves in format: [['from_cords'], ['to_cords']] */
        $moves = $this->getMovesCords($moves);

        /* If move sequence matched some opening, then return the nodes with moves that can be played after last played move */
        $matchingOpeningsNodes = array();

        foreach ($this->openings as $opening)
        {
            if ($opening->getRoot()->getData() == $moves[0]) {

                if (count($moves) == 1) $matchingOpeningsNodes[] = $opening->getRoot()->getChildren();
                else {
                    $matchingNode = $this->traverseOpeningTreeAndCompareMoves($opening, $moves, 2);
                    is_array($matchingNode) ? $matchingOpeningsNodes[] = $matchingNode : null;
                }
            }
        }

        return $matchingOpeningsNodes;
    }

    public function getNextMoveForGivenOpenings(array $matchingOpeningsNodes): array 
    {
        $potentialMoves = $this->getPositionPotentialMoves($matchingOpeningsNodes);

        return $potentialMoves[array_rand($potentialMoves)];
    }

    public function getPositionPotentialMoves(array $matchingOpeningsNodes): array
    {
        $potentialMoves = array();

        foreach ($matchingOpeningsNodes as $node)
        {
            /* Node can actually be an array of nodes, cause that is the way traverseOpeningTreeAndCompareMoves returns it as an array of node children */
            if (is_array($node)) {
                foreach ($node as $element) $potentialMoves[] = $element->getData();
            }
            else $potentialMoves[] = $node->getData();
        }

        return $potentialMoves;
    }

    private function traverseOpeningTreeAndCompareMoves($openingNode, $moves, $iteration = 2): ?array
    {
        $nodeChildren = isset($openingNode->root) ? $openingNode->getRoot()->getChildren() : $openingNode->getChildren();

        foreach($nodeChildren as $child)
        {
            if ($child->getData() == $moves[$iteration - 1])
            {
                /* If it is the last played move, then return node children as the next possible moves, and if not look further into opening theory */
                if (count($moves) == $iteration) return !empty($child->getChildren()) ? $child->getChildren(): null;
                return $this->traverseOpeningTreeAndCompareMoves($child, $moves, $iteration + 1);
            }
        }
        
        return null;
    }

    public function getMovesCords($moves): array
    {
        $movesCords = array();

        foreach ($moves as $key => $move) {
            $movesCords[$key] = [$move['previous_cords'], $move['new_cords_square']->getCords()];
        }

        return $movesCords;
    }

    private function fillOpeningsArray(): void
    {
        $this->openings['english'] = (new English())->getOpeningTree();
    }

    public function getOpenings(): array
    {
        return $this->openings;   
    }
}