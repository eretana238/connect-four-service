<?php
/**
 * @author Esteban Retana
 */
$json = file_get_contents($file);
$game = Game::fromJsonString($json);
$playerMove = $game->makePlayerMove($x, $y);
if ($playerMove->isWin || $playerMove->isDraw) {
    unlink($file); … exit; }
$opponentMove = $game->makeOpponentMove();
if ($opponentMove->isWin || $opponentMove->isDraw) {
    unlink($file); … exit; }
storeState($file, $game->toJsonString());
?>