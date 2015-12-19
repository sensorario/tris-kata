<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\ValueObject;

/** @todo row and col must accept only integer between 0, 1 and 2 */
final class Move extends ValueObject
    implements Behavior\Move
{
    public function createRandom()
    {
        $row = rand(0,2);
        $col = rand(0,2);

        return new self([
            'col' => $col,
            'row' => $row,
        ]);

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
            'col',
            'row',
        ];
    }
}
