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
    function __construct($width = 7, $height = 6, $isFull = false, $board = null) {
      $this->width = $width;
      $this->height = $height;
      $this->isFull = $isFull;
      if ($board == null) {
        $this->board = array();
        for($i = 0; $i < 6; $i++) 
            $this->board[] = array(0,0,0,0,0,0,0);
      }
      else {
        $this->board = $board;
      }
    }
    
    static function fromJson($json): Board {
      $board= new Board($json->{"width"},$json->{"height"},$json->{"isFull"},$json->{"board"});
      return $board;
    }
    /**
     * @param x, y, dx, dy, player
     */
    function checkPlaces($x, $y, $dx, $dy, $player) {
      // expand to left/lower: $x - $dx, $y - $dy …
      // expand to right/higher: $x + $dy, $y + $dy …
    }
}