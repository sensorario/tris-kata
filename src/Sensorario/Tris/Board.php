<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\Helpers\JsonExporter;
use Sensorario\ValueObject\ValueObject;

/** @todo should change status */
/** @todo accept a move */
/** @todo know tiles value */
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
                            'Already moved'
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

    public function getFreeTiles()
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

    public function gameIsEnd()
    {
        return 0 === $this->countFreeTiles();
    }
}
