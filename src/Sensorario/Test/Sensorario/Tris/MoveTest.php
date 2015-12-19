<?php

namespace Sensorario\Tris\Test\Sensorario\Tris;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris\Move;

final class MoveTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->move = Move::createRandom();
    }

    public function testOneTileIsTrue()
    {
        $numberOfTrueTiles = 0;
            for ($row = 0; $row <= 2; $row++) {
                for ($col = 0; $col <= 2; $col++) {
                    if ($this->move->get('row') == $row &&
                        $this->move->get('col') == $col
                    ) {
                        $numberOfTrueTiles++;
                    }
                }
            }

        $this->assertEquals(1, $numberOfTrueTiles);
    }
}
