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

        $this->firstPlayer = Tris\Player::box([
            'name' => 'Sensorario',
        ]);

        $this->players = [
            'first_player' => $this->firstPlayer,
            'second_player' => Tris\Player::box([
                'name' => 'Demo',
            ]),
        ];

        $this->board = Tris\Board::box($this->players);
    }

    public function testModeratorCreateTheBoard()
    {
        $this->moderator->expects($this->once())
            ->method('createBoardWithPlayers')
            ->will($this->returnValue($this->board));

        $game = new Tris\Game(
            $this->moderator
        );
    }
}
