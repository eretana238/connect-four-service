<?php

/**
 * Provides response documentation about the game
 * 
 * @author Esteban Retana
 */
define("WIDTH", 7);

define("HEIGHT", 6);

$strategies = array("Smart" => "SmartStrategy", "Random" => "RandomStrategy");

$info = array("width" => WIDTH, "height" => HEIGHT, "strategies" => array_keys($strategies));

echo json_encode($info);
