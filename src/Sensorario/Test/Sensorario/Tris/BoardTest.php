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
            $this->board->getMatrixOfTiles()
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

    public function testThereAreNineAvailableMoves()
    {
        $this->assertEquals(
            9,
            $this->board->countFreeTiles()
        );
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testCannotAcceptSamemoveTwice()
    {
        $this->board->move(Tris\Move::box([
            'row' => 1,
            'col' => 1,
        ]));

        $this->board->move(Tris\Move::box([
            'row' => 1,
            'col' => 1,
        ]));
    }

    public function testTrisIsNotDoneWithoutMoves()
    {
        $this->assertFalse(
            $this->board->trisIsDone()
        );
    }

    public function testTrisPerRow()
    {
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 0]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 0]));
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 2]));

        $this->assertTrue(
            $this->board->trisIsDone()
        );
    }

    public function testTrisPerColumn()
    {
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 0]));
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 0]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 2, 'col' => 0]));

        $this->assertTrue(
            $this->board->trisIsDone()
        );
    }

    public function testDiagonal()
    {
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 0]));
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 0]));
        $this->board->move(Tris\Move::box(['row' => 2, 'col' => 2]));

        $this->assertTrue(
            $this->board->trisIsDone()
        );
    }

    public function testInverseDiagonal()
    {
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 2]));
        $this->board->move(Tris\Move::box(['row' => 0, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 1]));
        $this->board->move(Tris\Move::box(['row' => 1, 'col' => 0]));
        $this->board->move(Tris\Move::box(['row' => 2, 'col' => 0]));

        $this->assertTrue(
            $this->board->trisIsDone()
        );
    }

    public function testSimulation()
    {
        $countActions = 0;

        do {
            try {
                $move = Tris\Move::createRandom();
                $this->board->move($move);
            } catch (\RuntimeException $e) { }
            $countActions++;
        } while ($this->board->countFreeTiles() !== 0);

        $this->assertTrue(
            $this->board->boardIsFull()
        );
    }
}
