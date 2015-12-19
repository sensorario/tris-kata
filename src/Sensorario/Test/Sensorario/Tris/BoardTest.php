<?php

namespace Sensorario\Test;

use PHPUnit_Framework_TestCase;
use Sensorario\Tris;

class BoardTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->firstPlayer = Tris\Player::box([
            'name' => 'Sensorario',
        ]);

        $this->secondPlayer = Tris\Player::box([
            'name' => 'Demo',
        ]);

        $this->board = Tris\Board::withPlayers([
            'first_player' => $this->firstPlayer,
            'second_player' => $this->secondPlayer,
        ]);
    }

    public function testStatusShouldContainAnArray()
    {
        $initialStatus = [
            [false, false, false],
            [false, false, false],
            [false, false, false],
        ];

        $this->assertEquals(
            $initialStatus,
            $this->board->getMove(0)
        );
    }

    public function testAfterAMoveStatusChange()
    {
        $move = [
            [false, false, false],
            [false, true,  false],
            [false, false, false],
        ];

        $this->assertEquals(
            $move,
            $this->board->move($move)
        );
    }

    public function testContainsCollectionOfAllPlayedMoves()
    {
        $move = [
            [false, false, false],
            [false, false, false],
            [false, false, false],
        ];

        $this->assertEquals(
            $move,
            $this->board->getMove(0)
        );
    }

    public function testMovesCollectionAfterFirstMove()
    {
        $move = [
            [false, false, false],
            [false, true,  false],
            [false, false, false],
        ];

        $this->board->move($move);

        $this->assertEquals(
            $move,
            $this->board->getMove(1)
        );
    }

    public function testMovesThreeTimes()
    {
        $this->board->move([
            [false, false, false],
            [false, true,  false],
            [false, false, false],
        ]);

        $this->board->move([
            [false, false, false],
            [false, false, false],
            [true,  false, false],
        ]);

        $this->board->move([
            [false, false, false],
            [false, false, false],
            [false, true,  false],
        ]);

        $freeTiles = [
            [false, false, false],
            [false, true,  false],
            [true,  true,  false],
        ];

        $this->assertEquals(
            $freeTiles,
            $this->board->getFreeTiles()
        );
    }

    public function testAfterMovePlayerChange()
    {
        $this->assertEquals(
            $this->firstPlayer,
            $this->board->currentPlayer()
        );
        $this->board->move(Tris\Move::createRandom());
        $this->assertEquals(
            $this->secondPlayer,
            $this->board->currentPlayer()
        );
    }
}
