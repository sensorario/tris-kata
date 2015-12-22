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

    if ($board->trisIsDone()) {
        echo "\n\nThe winner is: ";
        echo $board->lastPlayer()->get('name');
        echo "\n\n";
        die;
    }
};


try {
    do {
        try {
            $currentMove(Tris\Move::createRandom());
        } catch (Exception $e) {
        }
    } while ($board->matchIsNotFinished());
} catch (Tris\NoWinnerException $e) {
    echo "\n\nNobody wins\n\n";
    die;
}
