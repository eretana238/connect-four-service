<?php
/**
 * Board Model
 * 
 * @author Esteban Retana
 */
class Board {
    /**
     * @var int
     */
    private $width;
    /**
     * @var int
     */
    private $height;
    /**
     * @var array(array)
     */
    private $board;
    /**
     * @var array
     */
    private $row;
    /**
     * @var int
     */
    private $placesRemaining;
    /**
     * Contructor for Board. Initializes board array and dimensions and placesRemaining to false.
     */
    function __construct($width = 7, $height = 6, $placesRemaining = 42, $board = null) {
      $this->width = $width;
      $this->height = $height;
      $this->placesRemaining = $placesRemaining;
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
     * @return bool if provided slot is full
     */
    public function isSlotFull($x): bool {
        return $this->board[0][$x] != 0;
    }
    /**
     * Inserts token into the lowest available space in the slot.
     * 
     * @param x column for the board, token number representing the player or opponent's move
     * @return array with row index followed by column index
     */
    public function placeToken($x, $token) {
      for ($i = 0; $i < 5; $i++) {
        if ($this->board[$i+1][$x] != 0)
          $this->board[$i][$x] = $token;
          return array($i,$x);
      }
      $this->board[6][$x] = $token;
      return array(6,$x);
    }
    // 
    public function checkWin($x, $y, $player) {
      // check horizontally
      for ($col = 0; $col < 6; $col++) {

      }
      // check vertically
      for ($row = 0; $row < 5; $row++) {

      }
      // check negative diagonal

      // check positive diagonal
    }

    public function checkDraw() {
      return $this->placesRemaining == 0;
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