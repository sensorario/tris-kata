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

    // public function testStatusShouldContainAnArray()
    // {
    //     $initialStatus = [
    //         [false, false, false],
    //         [false, false, false],
    //         [false, false, false],
    //     ];

    //     $this->assertEquals(
    //         $initialStatus,
    //         $this->board->getMove(0)
    //     );
    // }

    public function testAfterAMoveStatusChange()
    {
        $move = Tris\Move::box([
            'col' => 1,
            'row' => 1,
        ]);

        $this->assertEquals(
            $move,
            $this->board->move(
                Tris\Move::box([
                    'col' => 1,
                    'row' => 1,
                ])
            )
        );
    }

    // public function testContainsCollectionOfAllPlayedMoves()
    // {
    //     $move = Tris\Move::box([
    //         'col' => 1,
    //         'row' => 1,
    //     ]);

    //     $this->assertEquals(
    //         $move,
    //         $this->board->getMove(0)
    //     );
    // }

    public function testMovesCollectionAfterFirstMove()
    {
        $move = Tris\Move::box([
            'col' => 1,
            'row' => 1,
        ]);

        $this->board->move($move);

        $this->assertEquals(
            $move,
            $this->board->getMove(0)
        );
    }

    public function testMovesThreeTimes()
    {
        $this->board->move(Tris\Move::box([
            'row' => 1,
            'col' => 1,
        ]));

        $this->board->move(Tris\Move::box([
            'row' => 1,
            'col' => 2,
        ]));

        $this->board->move(Tris\Move::box([
            'row' => 2,
            'col' => 0,
        ]));

        $freeTiles = [
            [false,false, false],
            [false, true,  true],
            [true, false, false],
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
