<?php

namespace Sensorario\Tris;

class Moderator
    implements Behavior\Moderator
{
    public function greet()
    {

    }

    public function createBoardWithPlayers(array $players)
    {
        return Board::withPlayers($players);
    }

    public function askMove(Player $player)
    {

    }
}
