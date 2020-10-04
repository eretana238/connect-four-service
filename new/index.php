<?php

/**
 * Create new game based on strategy provided
 * 
 * @author Esteban Retana
 */
include_once dirname(__DIR__) . "/play/Game.php";
include_once dirname(__DIR__) . "/play/RandomStrategy.php";
include_once dirname(__DIR__) . "/play/SmartStrategy.php";

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
$newGame = array("strategy" => $strategyObj->toJson(), "board" => $board);

$fp = fopen(dirname(__DIR__) . "/writable/$pid.json", "w");

fwrite($fp, json_encode($newGame));

fclose($fp);

echo json_encode(array("response" => true, "pid" => $pid));
?>