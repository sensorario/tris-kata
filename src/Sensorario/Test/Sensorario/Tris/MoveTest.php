<?php

namespace Sensorario\Tris\Test\Sensorario\Tris;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris\Move;

final class MoveTest extends PHPUnit_Framework_TestCase
{
    public function testOneTileIsTrue()
    {
        $move = Move::createRandom();

        $trueTiles = 0;
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $trueTiles += $move[$i][$j] == true;
            }
        }

        $this->assertEquals(1, $trueTiles);
    }
}
