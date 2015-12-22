<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\Helpers\JsonExporter;
use Sensorario\ValueObject\ValueObject;

final class Board extends ValueObject
    implements Behavior\Board
{
    const EMPTY_TILE = false;

    private $moves = [];

    public function withPlayers(array $players = [])
    {
        return new self($players);
    }

    public static function mandatory()
    {
        return [
            'first_player',
            'second_player',
        ];
    }

    public static function types()
    {
        return [
            'first_player'  => [
                'object' => 'Sensorario\Tris\Player',
            ],
            'second_player' => [
                'object' => 'Sensorario\Tris\Player',
            ],
        ];
    }

    public function move(Move $new)
    {
        foreach ($this->moves as $move) {
            for ($row = 0; $row <= 2; $row++) {
                for ($col = 0; $col <= 2; $col++) {
                    if ($move == $new) {
                        throw new \RuntimeException(
                            'Already moved here'
                        );
                    }
                }
            }
        }

        $this->moves[] = $new;
        return end($this->moves);
    }

    public function getMove($position)
    {
        return $this->moves[$position];
    }

    public function getMatrixOfTiles()
    {
        $final = [
            [false, false, false],
            [false, false, false],
            [false, false, false],
        ];

        foreach ($this->moves as $move) {
            for ($row = 0; $row <= 2; $row++) {
                for ($col = 0; $col <= 2; $col++) {
                    if ($move->get('row') == $row &&
                        $move->get('col') == $col
                    ) {
                        $final[$row][$col] = true;
                    }
                }
            }
        }

        return $final;
    }

    public function currentPlayer()
    {
        return $this->get(
            count($this->moves) % 2 == 0
            ? 'first_player'
            : 'second_player'
        );
    }

    /** @todo test this method */
    public function lastPlayer()
    {
        return $this->get(
            count($this->moves) % 2 == 1
            ? 'first_player'
            : 'second_player'
        );
    }

    public function countFreeTiles()
    {
        $numberOfFreeTiles = 9;

        foreach ($this->moves as $move) {
            for ($row = 0; $row <= 2; $row++) {
                for ($col = 0; $col <= 2; $col++) {
                    if ($move->get('row') == $row &&
                        $move->get('col') == $col
                    ) {
                        $numberOfFreeTiles--;
                    }
                }
            }
        }

        return $numberOfFreeTiles;
    }

    public function boardIsFull()
    {
        return 0 === $this->countFreeTiles();
    }

    public function trisIsDone()
    {
        $tiles = $this->getMatrixOfTiles();

        if (3 === $tiles[0][0] + $tiles[1][1] + $tiles[2][2]) {
            return true;
        }

        if (3 === $tiles[0][2] + $tiles[1][1] + $tiles[0][2]) {
            return true;
        }

        for ($i = 0; $i < 2; $i++) {
            if (3 === array_sum($tiles[$i])) {
                return true;
            }

            for ($sum = 0, $row = 0; $row <= 2; $row++) {
                $sum += $tiles[$row][$i];
                if (3 === $sum) {
                    return true;
                }
            }
        }

        return false;
    }

    /** @todo test */
    public function matchIsNotFinished()
    {
        return !$this->trisIsDone();
    }
}
