<?php
/**
 * Start game from PID created
 * 
 * @author Esteban Retana
 */
define('PID', 'pid');

define('MOVE', 'move')
//  TODO: get reguset for pid=p&move=x

$json = file_get_contents("../../writable/db.json");
$game = Game::fromJsonString($json);
$playerMove = $game->makePlayerMove($x, $y);
if ($playerMove->isWin || $playerMove->isDraw) {
    unlink($file); … exit; }
$opponentMove = $game->makeOpponentMove();
if ($opponentMove->isWin || $opponentMove->isDraw) {
    unlink($file); … exit; }
storeState($file, $game->toJsonString());
?>