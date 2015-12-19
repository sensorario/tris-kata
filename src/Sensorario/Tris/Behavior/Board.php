<?php

namespace Sensorario\Tris\Behavior;

interface Board
{
    public function move(array $tiles);

    public function getMove($index);

    public function getFreeTiles();

    public function currentPlayer();
}
