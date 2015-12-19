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

$currentMove = function ($move) use ($board) {
    $player = $board->currentPlayer();
    $lastMove = $board->move($move);
    echo "\nMove: ";
    echo $player->get('name');
    echo " moved in ";
    echo " col " . $lastMove->get('col');
    echo " row " . $lastMove->get('row');
};

$currentMove(Tris\Move::box(['row' => 0, 'col' => 1]));
$currentMove(Tris\Move::box(['row' => 1, 'col' => 2]));
$currentMove(Tris\Move::box(['row' => 0, 'col' => 2]));
$currentMove(Tris\Move::box(['row' => 2, 'col' => 2]));
$currentMove(Tris\Move::box(['row' => 0, 'col' => 3]));
