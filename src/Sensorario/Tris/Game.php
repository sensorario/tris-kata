<?php

namespace Sensorario\Tris;

/** @todo ask to moderator who start the game */
final class Game
{
    private $board;

    public function __construct(
        Moderator $moderator
    ) {
        $moderator->greet();

        $this->board = $moderator->createBoardWithPlayers([
            Player::box(['name' => 'Sensorario']),
            Player::box(['name' => 'Demo']),
        ]);

        $moderator->askMove(
            $this->firstPlayer()
        );
    }

    public function firstPlayer()
    {
        return $this->board->get('first_player');
    }
}
