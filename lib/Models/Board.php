<?php
/**
 * Board Model
 * 
 * @author Esteban Retana
 * 
 */
class Board {
    /**
     * @var array(array)
     */
    public $board;
    /**
     * @var boolean
     */
    public $isFull;
    /**
     * Contructor for Board
     */
    function __construct() {
        $board = array();
        for($i = 0; $i < 6; $i++) 
            $board[] = array(0,0,0,0,0,0,0);
    }
    /**
     * 
     * @param x, y, dx, dy, player
     */
    function checkPlaces($x, $y, $dx, $dy, $player) {
      // expand to left/lower: $x - $dx, $y - $dy …
      // expand to right/higher: $x + $dy, $y + $dy …
        // check if board is full
    }
}
?>