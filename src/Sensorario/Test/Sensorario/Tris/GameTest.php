<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris;

class GameTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->moderator = $this->getMockBuilder('Sensorario\Tris\Moderator')
            ->getMock();
    }

    public function testGameStartsWithModeratorGreetings()
    {
        $this->moderator->expects($this->once())
            ->method('greet');

        new Tris\Game(
            $this->moderator
        );
    }

    /** @todo improve test name */
    public function testModeratorCreateTheBoard()
    {
        $firstPlayer = Tris\Player::box();

        $players = [
            'first_player' => $firstPlayer,
            'second_player' => Tris\Player::box(),
        ];

        $this->board = Tris\Board::box($players);

        $this->moderator->expects($this->once())
            ->method('createBoard')
            ->will($this->returnValue($this->board));

        $this->game = new Tris\Game(
            $this->moderator
        );

        $this->assertEquals(
            $firstPlayer,
            $this->game->firstPlayer()
        );
    }
}
