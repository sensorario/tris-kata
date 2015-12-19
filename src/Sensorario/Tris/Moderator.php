<?php

namespace Sensorario\Tris;

class Moderator
    implements Behavior\Moderator
{
    public function createBoardWithPlayers(array $players)
    {
        return Board::withPlayers($players);
    }
}
