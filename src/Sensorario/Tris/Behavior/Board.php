<?php

namespace Sensorario\Tris\Behavior;

use Sensorario\Tris;

interface Board
{
    public function move(Tris\Move $tiles);

    public function getMove($index);

    public function getFreeTiles();

    public function currentPlayer();
}
