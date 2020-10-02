<?php
/**
 * Board Model
 * 
 * @author Esteban Retana
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
     * @var int
     */
    public $width;
    /**
     * @var int
     */
    public $height;
    /**
     * Contructor for Board. Initializes board array and dimensions and isFull to false.
     */
    function __construct() {
      $this->width = 7;
      $this->height = 6;
      $this->isFull = false;
      $this->board = array();
      for($i = 0; $i < 6; $i++) 
          $this->board[] = array(0,0,0,0,0,0,0);
    }
    /**
     * @param x, y, dx, dy, player
     */
    function checkPlaces($x, $y, $dx, $dy, $player) {
      // expand to left/lower: $x - $dx, $y - $dy …
      // expand to right/higher: $x + $dy, $y + $dy …
    }
}