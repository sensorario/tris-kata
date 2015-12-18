<?php

namespace Sensorario\Tris;

class Moderator
{
    public function greet()
    {

    }

    public function createBoardWithPlayers(array $players)
    {
        return Board::withPlayers($players);
    }
}
