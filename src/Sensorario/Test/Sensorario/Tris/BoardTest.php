<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris\Board;

class BoardTest extends PHPUnit_Framework_TestCase
{
    public function testBoardHasNineTiles()
    {
        $this->assertTrue(9 === Board::EMPTY_TILES);
    }
}
