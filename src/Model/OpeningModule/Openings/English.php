<?php 

namespace App\Model\OpeningModule\Openings;

use App\Model\OpeningModule\Tree;
use App\Model\OpeningModule\TreeNode;
use App\Model\OpeningModule\Openings\OpeningInterface;

class English implements OpeningInterface
{
    public function getOpeningTree(): Tree
    {
        $whiteC4 = new TreeNode([[2, 3], [4, 3]]);

        $tree = new Tree($whiteC4);

        $blackC4E5 = new TreeNode([[7, 5], [5, 5]]);
        $whiteE5G3 = new TreeNode([[2, 7], [3, 7]]);
        $whiteBb4G3 = new TreeNode([[2, 7], [3, 7]]);
        $whiteBb4Qc2 = new TreeNode([[1, 4], [2, 3]]);
        $whiteBb4Nd5 = new TreeNode([[3, 3], [5, 4]]);
        $whiteE5Nc3 = new TreeNode([[1, 2], [3, 3]]);
        $blackNc3Bb4 = new TreeNode([[8, 6], [4, 2]]);
        $blackG3Bxc3 = new TreeNode([[4, 2], [3, 3]]);
        $whiteBxc3bxc3 = new TreeNode([[2, 2], [3, 3]]);
        $blackNd5Nc6 = new TreeNode([[8, 2], [6, 3]]);
        $blackNc3Nf6 = new TreeNode([[8, 7], [6, 6]]);
        $whiteNf6G3 = new TreeNode([[2, 7], [3, 7]]);
        $blackG3D5 = new TreeNode([[7, 4], [5, 4]]);
        $whiteD5Cxd5 = new TreeNode([[4, 3], [5, 4]]);
        $blackCxd5Nxd5 = new TreeNode([[6, 6], [5, 4]]);
        $whiteNxd5Bg2 = new TreeNode([[1, 6], [2, 7]]);
        $blackBg2Nb6 = new TreeNode([[5, 4], [6, 2]]);
        $whiteNb6E3 = new TreeNode([[2, 5], [3, 5]]);
        $whiteNxd5Nf3 = new TreeNode([[1, 7], [3, 6]]);
        $whiteNc6Nf3 = new TreeNode([[1, 7], [3, 6]]);
        $blackNf3E4 = new TreeNode([[5, 5], [4, 5]]);
        $whiteE4Ng5 = new TreeNode([[3, 6], [5, 7]]);
        $blackNg5Qxg5 = new TreeNode([[8, 4], [5, 7]]);

        $blackG3Bxc3->addChildren($whiteBxc3bxc3); /* c4, e5, Nc3, Bb4, g3, Bxc3, bxc3 */

        $whiteBb4G3->addChildren($blackG3Bxc3); /* c4, e5, Nc3, Bb4, g3, Bxc3 */

        $whiteE4Ng5->addChildren($blackNg5Qxg5); /* c4, e5, Nc3, Bb4, Nd5, Nc6, Nf3, E4, Ng5, Qxg5 */

        $blackNf3E4->addChildren($whiteE4Ng5); /* c4, e5, Nc3, Bb4, Nd5, Nc6, Nf3, E4, Ng5 */

        $whiteNc6Nf3->addChildren($blackNf3E4); /* c4, e5, Nc3, Bb4, Nd5, Nc6, Nf3, E4 */

        $blackNd5Nc6->addChildren($whiteNc6Nf3); /* c4, e5, Nc3, Bb4, Nd5, Nc6, Nf3 */
        
        $whiteBb4Nd5->addChildren($blackNd5Nc6); /* c4, e5, Nc3, Bb4, Nd5, Nc6 */

        $blackNc3Bb4->addChildren($whiteBb4G3); /* c4, e5, Nc3, Bb4, g3 */
        $blackNc3Bb4->addChildren($whiteBb4Qc2); /* c4, e5, Nc3, Bb4, qC2 */
        $blackNc3Bb4->addChildren($whiteBb4Nd5); /* c4, e5, Nc3, Bb4, Nd5 */

        $blackBg2Nb6->addChildren($whiteNb6E3); /* c4, e5, Nc3, Nf6, g3, d5, cxd5, Nxd5, Bg2, Nb6, e3 */

        $whiteNxd5Bg2->addChildren($blackBg2Nb6); /* c4, e5, Nc3, Nf6, g3, d5, cxd5, Nxd5, Bg2, Nb6 */

        $blackCxd5Nxd5->addChildren($whiteNxd5Bg2); /* c4, e5, Nc3, Nf6, g3, d5, cxd5, Nxd5, Bg2 */
        $blackCxd5Nxd5->addChildren($whiteNxd5Nf3); /* c4, e5, Nc3, Nf6, g3, d5, cxd5, Nxd5, Nf3 */

        $whiteD5Cxd5->addChildren($blackCxd5Nxd5);  /* c4, e5, Nc3, Nf6, g3, d5, cxd5, Nxd5 */

        $blackG3D5->addChildren($whiteD5Cxd5); /* c4, e5, Nc3, Nf6, g3, d5, cxd5 */

        $whiteNf6G3->addChildren($blackG3D5); /* c4, e5, Nc3, Nf6, g3, d5 */

        $blackNc3Nf6->addChildren($whiteNf6G3); /* c4, e5, Nc3, Nf6, g3 */

        $whiteE5Nc3->addChildren($blackNc3Bb4); /* c4, e5, Nc3, Bb4 */
        $whiteE5Nc3->addChildren($blackNc3Nf6); /* c4, e5, Nc3, Nf6 */

        $blackC4E5->addChildren($whiteE5G3); /* c4, e5, g3 */
        $blackC4E5->addChildren($whiteE5Nc3); /* c4, e5, Nc3 */

        $whiteC4->addChildren($blackC4E5); /* c4, e5 */

        return $tree;
    }
}