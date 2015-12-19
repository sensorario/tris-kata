<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\ValueObject;

final class Move extends ValueObject
    implements Behavior\Move
{
    public function createRandom()
    {
        $row = rand(0,2);
        $col = rand(0,2);
        $move = [];

        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $move[$i][$j] = $j == $row && $i == $col;
            }
        }

        return $move;
    }

    public static function mandatory()
    {
        return [
            'row',
            'col',
        ];
    }
}
