<?php

namespace Sensorario\Tris\Behavior;

interface Board
{
    public function getInitialStatus();

    public function move(array $tiles);

    public function getMove($index);

    public function getFreeTiles();
}
