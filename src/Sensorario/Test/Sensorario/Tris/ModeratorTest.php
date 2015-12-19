<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris;

class ModeratorTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $this->board = Tris\Board::box([
            'first_player' => Tris\Player::box(['name' => 'Sensorario']),
            'second_player' => Tris\Player::box(['name' => 'Demo']),
        ]);

        $this->moderator = new Tris\Moderator(
            $this->board
        );
    }
}
