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

        $this->board = $moderator->createBoard();
    }

    public function firstPlayer()
    {
        return $this->board->get('first_player');
    }
}
