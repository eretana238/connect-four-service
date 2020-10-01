<?php 
/**
 * Create new game based on strategy provided
 * 
 * @author Esteban Retana
 */
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
echo json_encode(array("response" => true, "PID" => $pid));
