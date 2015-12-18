<?php

namespace Sensorario\Tris;

use Sensorario\ValueObject\ValueObject;

final class Player extends ValueObject
{
    public static function mandatory()
    {
        return [
            'name',
        ];
    }
}
