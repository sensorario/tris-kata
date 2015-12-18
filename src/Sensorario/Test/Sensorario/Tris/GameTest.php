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

    public function testGameKnowsPlayerViaModerator()
    {
        $firstPlayer = Tris\Player::box([
            'name' => 'Sensorario',
        ]);

        $players = [
            'first_player' => $firstPlayer,
            'second_player' => Tris\Player::box([
                'name' => 'Demo',
            ]),
        ];

        $this->board = Tris\Board::box($players);

        $this->moderator->expects($this->once())
            ->method('createBoardWithPlayers')
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
