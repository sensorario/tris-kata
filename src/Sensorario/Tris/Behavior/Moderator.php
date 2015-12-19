<?php

namespace Sensorario\Tris\Behavior;

use Sensorario\Tris;

interface Moderator
{
    public function __construct(Tris\Board $board);

    public function doMove();
}
