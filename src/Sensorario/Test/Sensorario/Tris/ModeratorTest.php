<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris;

class ModeratorTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testModeratorPushPlauyersToMove()
    {
        $moderator = new Tris\Moderator();
        $board = $moderator->createBoardWithPlayers([
            'first_player' => Tris\Player::box(['name' => 'Sensorario']),
            'second_player' => Tris\Player::box(['name' => 'Demo']),
        ]);
    }
}
