<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\ValueObject;

/** @todo should change status */
/** @todo accept a move */
/** @todo know tiles value */
final class Board extends ValueObject
    implements Behavior\Board
{
    const EMPTY_TILE = false;

    private $moves = [[
        [false, false, false],
        [false, false, false],
        [false, false, false],
    ]];

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

    public function move(array $tiles)
    {
        $this->moves[] = $tiles;
        return end($this->moves);
    }

    public function getMove($position)
    {
        return $this->moves[$position];
    }

    public function getFreeTiles()
    {
        $final = $this->getMove(0);
        foreach ($this->moves as $play) {
            for ($i = 0; $i <= 2; $i++) {
                for ($j = 0; $j <= 2; $j++) {
                    if ($play[$i][$j]) {
                        $final[$i][$j] = $play[$i][$j];
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
            ? 'second_player'
            : 'first_player'
        );
    }
}
