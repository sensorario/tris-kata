<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris;

class BoardTest extends PHPUnit_Framework_TestCase
{
    public function testBoardHasNineTiles()
    {
        $this->assertTrue(9 === Tris\Board::EMPTY_TILES);
    }

    public function testAcceptTwoPlayers()
    {
        Tris\Board::withPlayers([
            'first_player' => Tris\Player::box(),
            'second_player' => Tris\Player::box(),
        ]);
    }
}
