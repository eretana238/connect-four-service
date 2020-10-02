<?php 
/**
 * Create new game based on strategy provided
 * 
 * @author Esteban Retana
 */
require('../lib/Models/Game.php');


define('STRATEGY', 'strategy'); 

$strategies = array("Smart", "Random"); 

if (!array_key_exists(STRATEGY, $_GET)) { 
    echo json_encode(array("response" => false, "reason" => "Strategy not specified"));
    exit; 
}
/**
 * @var string
 */
$strategy = $_GET[STRATEGY];

if (!in_array($strategy, $strategies)) {
    echo json_encode(array("response" => false, "reason" => "Unknown strategy"));
    exit;
}
/**
 * @var string
 */
$pid = uniqid();

$game = new Game();

$board = $game->board;

$newGame = array("pid" => $pid, "strategy" => $strategy, "board" => $game->board);

$fp = fopen("../writable/db.json","w");

fwrite($fp, json_encode($newGame));

fclose($fp);

echo json_encode(array("response" => true, "pid" => $pid));
