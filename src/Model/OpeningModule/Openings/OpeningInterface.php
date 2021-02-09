<?php 

namespace App\Model\OpeningModule\Openings;

use App\Model\OpeningModule\Tree;

interface OpeningInterface 
{
    public function getOpeningTree(): Tree;
}