<?php

namespace Sensorario\Tris;

/** @todo ask to moderator who start the game */
final class Game
{
    private $board;

    public function __construct(
        Moderator $moderator
    ) {
        $this->board = $moderator->createBoardWithPlayers([
            Player::box(['name' => 'Sensorario']),
            Player::box(['name' => 'Demo']),
        ]);
    }
}
