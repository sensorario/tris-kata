<?php

namespace Sensorario\Tris\Test\Sensorario\Tris;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris;

final class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->player = Tris\Player::box([
            'name' => 'Sensorario',
        ]);
    }

    public function testOneTileIsTrue()
    {
        $this->assertInstanceOf(
            'Sensorario\Tris\Move',
            $this->player->move()
        );
    }
}
