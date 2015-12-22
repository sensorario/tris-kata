<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\Helpers\Jsonxporter;
use Sensorario\ValueObject\ValueObject;

final class Board extends ValueObject
    implements Behavior\Board
{
    const EMPTY_TILE = false;

    private $moves = [];

    private $movesPerPlayer = [];

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

        $currentName = $this->currentPlayer()->get('name');
        $this->movesPerPlayer
            [$currentName]
            [$new->get('row')]
            [$new->get('col')] = true;

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
        $playerName = $this->currentPlayer()->get('name');

        if (!isset($this->movesPerPlayer[$playerName])) {
            return false;
        }

        $tiles = $this->movesPerPlayer[$playerName];

        for ($row = 0; $row < 3; $row++) {
            if (
                isset($tiles[$row][0]) &&
                isset($tiles[$row][1]) &&
                isset($tiles[$row][2])
            ) {
                return true;
            }
        }

        for ($col = 0; $col < 3; $col++) {
            if (
                isset($tiles[0][$col]) &&
                isset($tiles[1][$col]) &&
                isset($tiles[2][$col])
            ) {
                return true;
            }
        }

        return 
            isset($tiles[0][0]) &&
            isset($tiles[1][1]) &&
            isset($tiles[2][2])
            ||
            isset($tiles[0][2]) &&
            isset($tiles[1][1]) &&
            isset($tiles[2][0])
        ;
    }

    public function matchIsNotFinished()
    {
        if (count($this->moves) === 9) {
            throw new NoWinnerException(
                ''
            );
        }

        return !$this->trisIsDone();
    }
}
