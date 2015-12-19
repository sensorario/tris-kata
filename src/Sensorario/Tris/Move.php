<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\ValueObject;

final class Move extends ValueObject
    implements Behavior\Move
{
    public function createRandom()
    {
        return [
            [false, false, false],
            [false, false, false],
            [false, true,  false],
        ];
    }

    public static function mandatory()
    {
        return [
            'row',
            'col',
        ];
    }
}
