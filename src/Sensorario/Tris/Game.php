<?php

namespace Sensorario\Tris;

/** @todo ask to moderator who start the game */
final class Game
{
    private $board;

    public function __construct(
        Moderator $moderator
    ) {
        $moderator->createBoardWithPlayers([
            Player::box(['name' => 'Sensorario']),
            Player::box(['name' => 'Demo']),
        ]);

        for ($i = 0; $i < 9; $i++) {
            $moderator->doMove();
        }
    }
}
