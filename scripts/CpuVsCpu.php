<?php

require_once 'vendor/autoload.php';

use Sensorario\Tris;

$board = Tris\Board::box([
    'first_player' => Tris\Player::box([
        'name' => 'Simone',
    ]),
    'second_player' => Tris\Player::box([
        'name' => 'Demo',
    ]),
]);

$move = Tris\Move::box(['row' => 0, 'col' => 2]);
$board->move($move);

echo "\nFree moves: ";
echo $board->countFreeTiles();

$move = Tris\Move::box(['row' => 1, 'col' => 2]);
$board->move($move);

echo "\nFree moves: ";
echo $board->countFreeTiles();
