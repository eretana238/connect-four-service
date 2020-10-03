<?php
/**
 * Start game from PID created
 * 
 * @author Esteban Retana
 */
include_once "../lib/Models/Game.php";

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

$file = "../writable/$pid.json";

if (!file_exists($file)) {
    echo json_encode(array("response" => false, "reason" => "Unknown pid"));
    exit;
}

$slot = inval($move);

if ($slot < 0 || $slot > 6) {
    echo json_encode(array("response" => false, "reason" => "Invalid slot, $slot"));
    exit;
}

$json = file_get_contents($file);

$game = Game::fromJsonString($json);

$playerMove = $game->makePlayerMove($x);

if ($playerMove->isWin || $playerMove->isDraw) {
    unlink($file);
    echo encodeMoves($playerMove);
    exit; 
}

$opponentMove = $game->makeOpponentMove();

if ($opponentMove->isWin || $opponentMove->isDraw) {
    unlink($file);
    echo encodeMoves($playerMove, $opponentMove);
    exit; 
}
    
storeState($file, $game->toJsonString());

function encodeMoves(Move $playerMove, $opponentMove = null): json {
    if ($opponentMove = null) {
        $response = array("response" => true, "ack_move" => $playerMove);
        return json_encode($response);
    }
    else {
        $response = array("reponse" => true, "ack_move" => $playerMove, "move" => $opponentMove);
    }
    return $response;
}