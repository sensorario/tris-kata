<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris;

class ModeratorTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->moderator = new Tris\Moderator(Tris\Board::box());
    }

    public function testModeratorPushPlauyersToMove()
    {
        $board = $this->moderator->createBoardWithPlayers([
            'first_player' => Tris\Player::box(['name' => 'Sensorario']),
            'second_player' => Tris\Player::box(['name' => 'Demo']),
        ]);
    }
}
