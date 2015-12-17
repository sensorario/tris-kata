<?php

namespace Sensorario\Tris;

final class Game
{
        public function __construct(
            Moderator $moderator
        ) {
            $moderator->greet();
        }
}
