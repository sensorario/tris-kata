<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\ValueObject;

/** @todo should change status */
/** @todo accept a move */
/** @todo know tiles value */
final class Board extends ValueObject
{
    const EMPTY_TILES = 9;

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
}
