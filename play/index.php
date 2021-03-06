<?php

/**
 * Start game from PID created
 * 
 * @author Esteban Retana
 */
include_once __DIR__ . "/Game.php";

define("PID", "pid");
define("MOVE", "move");

if (!array_key_exists(PID, $_GET)) {
    echo json_encode(array("response" => false, "reason" => "Pid not specified"));
    exit;
}

if (!array_key_exists(MOVE, $_GET)) {
    echo json_encode(array("response" => false, "reason" => "Move not specified"));
    exit;
}

$pid = $_GET[PID];

$move = $_GET[MOVE];

$file = dirname(__DIR__) . "/writable/$pid.json";

if (!file_exists($file)) {
    echo json_encode(array("response" => false, "reason" => "Unknown pid"));
    exit;
}

$slot = intval($move);

if ($slot < 0 || $slot > 6) {
    echo json_encode(array("response" => false, "reason" => "Invalid slot, $slot"));
    exit;
}

$jsonString = file_get_contents($file);

$game = Game::fromJsonString($jsonString);

$playerMove = $game->makePlayerMove($slot);

if ($playerMove->isWin || $playerMove->isDraw) {
    unlink($file);
    echo toJson($playerMove);
    exit;
}

$opponentMove = $game->makeOpponentMove();

if ($opponentMove->isWin || $opponentMove->isDraw) {
    unlink($file);
    echo toJson($playerMove, $opponentMove);
    exit;
}

$fp = fopen($file, "w");

fwrite($fp, json_encode($game));

fclose($fp);

echo toJson($playerMove, $opponentMove);

function toJson(Move $playerMove, $opponentMove = null): string
{
    if ($opponentMove == null) {
        $response = array("response" => true, "ack_move" => $playerMove);
    } else {
        $response = array("reponse" => true, "ack_move" => $playerMove, "move" => $opponentMove);
    }
    return json_encode($response);
}
?>