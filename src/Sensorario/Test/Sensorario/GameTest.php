<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris\Game;
use Sensorario\Tris\Moderator;

class GameTest extends PHPUnit_Framework_TestCase
{
    public function testGameStartsWithModeratorGreetings()
    {
        $this->moderator = $this->getMockBuilder('Sensorario\Tris\Moderator')
            ->getMock();

        $this->moderator->expects($this->once())
            ->method('greet');

        new Game(
            $this->moderator
        );
    }
}

