<?php

namespace Sensorario\Tris\Behavior;

use Sensorario\Tris;

interface Moderator
{
    public function askMove(Tris\Player $player);
}
