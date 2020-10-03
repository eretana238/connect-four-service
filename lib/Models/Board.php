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
    private $board;
    /**
     * @var array
     */
    private $row;
    /**
     * @var boolean
     */
    private $isFull;
    /**
     * @var int
     */
    private $width;
    /**
     * @var int
     */
    private $height;
    /**
     * Contructor for Board. Initializes board array and dimensions and isFull to false.
     */
    function __construct($width = 7, $height = 6, $isFull = false, $board = null) {
      $this->width = $width;
      $this->height = $height;
      $this->isFull = $isFull;
      if ($board == null) {
        $this->board = array();
        for ($i = 0; $i < 6; $i++) 
            $this->board[] = array(0,0,0,0,0,0,0);
      }
      else {
        $this->board = $board;
      }
    }
    /**
     * Converts json data into a Board instance.
     * 
     * @param json data
     * @return Board instance from json data
     */
    static function fromJson($json): Board {
      $board= new Board($json->{"width"},$json->{"height"},$json->{"isFull"},$json->{"board"});
      return $board;
    }
    /**
     * Verifies if a token can be inserted in the given slot.
     * 
     * @param x column for the board
     * @return boolean if provided slot is full
     */
    public function isSlotFull($x): boolean {
        return $this->board[0][$x] != 0;
    }

    public function placeToken($x, $token) {
      for ($i = 0; $i < 5; $i++) {
        if ($this->board[$i+1][$x] != 0)
          $this->board[$i][$x] = $token;
          return;
      }
      $this->board[6][$x] = $token;
    }
    /**
     * Getter for winning row
     * 
     * @return array row
     */
    public function getRow() {
      return $this->row;
    }
}