<?php

/**
 * Create new game based on strategy provided
 * 
 * @author Esteban Retana
 */
require_once "../lib/Models/Game.php";
require_once "../lib/Strategies/RandomStrategy.php";
require_once "../lib/Strategies/SmartStrategy.php";

define('STRATEGY', 'strategy');

$strategies = array("Smart", "Random");

if (!array_key_exists(STRATEGY, $_GET)) {
    echo json_encode(array("response" => false, "reason" => "Strategy not specified"));
    exit;
}

$strategy = $_GET[STRATEGY];

if (!in_array($strategy, $strategies)) {
    echo json_encode(array("response" => false, "reason" => "Unknown strategy"));
    exit;
}

$pid = uniqid(); // unique id

$game = new Game();

$board = $game->board;

if ($strategy == "Random") {
    $strategyObj = new RandomStrategy();
} else {
    $strategyObj = new SmartStrategy();
}
$newGame = array("pid" => $pid, "strategy" => $strategyObj->toJson(), "board" => $board);

$fp = fopen("../writable/$pid.json", "w");

fwrite($fp, json_encode($newGame));

fclose($fp);

echo json_encode(array("response" => true, "pid" => $pid));
