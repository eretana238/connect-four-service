<?php

/**
 * Board Model
 * 
 * @author Esteban Retana
 */
define("WIDTH", 7);

define("HEIGHT", 6);

class Board
{
    /**
     * @var array(array)
     */
    public $board;
    /**
     * @var array
     */
    public $row;
    /**
     * Contructor for Board. Initializes board array and dimensions and placesRemaining to false.
     */
    function __construct($board = null, $row = array())
    {
        if ($board == null) {
            $this->board = array();
            for ($i = 0; $i < 6; $i++)
                $this->board[] = array(0, 0, 0, 0, 0, 0, 0);
        } else {
            $this->board = $board;
        }
        $this->row = $row;
    }
    /**
     * Converts json data into a Board instance.
     * 
     * @param json data
     * @return Board instance from json data
     */
    static function fromJson($json): Board
    {
        $board = new Board($json->{"board"}, $json->{"row"});
        return $board;
    }
    /**
     * Verifies if a token can be inserted in the given slot.
     * 
     * @param x column for the board
     * @return bool if provided slot is full
     */
    public function isSlotFull($x): bool
    {
        return $this->board[0][$x] != 0;
    }
    /**
     * Inserts token into the lowest available space in the slot.
     * 
     * @param x column for the board, token number representing the player or opponent's move
     * @return array with row index followed by column index
     */
    public function placeToken($x, $token): array
    {
        for ($i = 0; $i < HEIGHT - 1; $i++) {
            if ($this->board[$i + 1][$x] != 0) {
                $this->board[$i][$x] = $token;
                return array($i, $x);
            }
        }
        $this->board[HEIGHT - 1][$x] = $token;
        return array(HEIGHT - 1, $x);
    }
    /**
     * Checks if the piece in the board has made winning move.
     * 
     * @param x column for board, y row for board, token is player or AI game piece identifier
     * @return bool
     */
    function checkWin($x, $y, $token): bool
    {
        $counter = 0;
        // check horizontally
        for ($col = 0; $col < 7; $col++) {
            if ($this->board[$y][$col] == $token) {
                $counter++;
                array_push($this->row, $col, $y);
            } else {
                $counter = 0;
                $this->row = array();
            }
            if ($counter == 4) {
                return true;
            }
        }
        $counter = 0;
        $this->row = array();
        // check vertically
        for ($row = 0; $row < 6; $row++) {
            if ($this->board[$row][$x] == $token) {
                $counter++;
                array_push($this->row, $x, $row);
            } else {
                $counter = 0;
                $this->row = array();
            }

            if ($counter == 4) {
                return true;
            }
        }
        // check negative diagonal
        if ($this->checkNegativeDiagonal($x, $y, $token))
            return true;

        // check positive diagonal
        if ($this->checkPositiveDiagonal($x, $y, $token))
            return true;

        return false;
    }
    /**
     * Checks if the piece in the board has made negative diagonal winning move.
     * 
     * @param x column for board, y row for board, token is player or AI game piece identifier
     * @return bool
     */
    function checkNegativeDiagonal($x, $y, $token): bool
    {
        $row = $y;
        $col = $x;
        if ($row == 0 or $col == 0) {
            $col = $x;
        } else {
            for ($col = $x; $col >= 0; $col--) {
                if ($row >= 6)
                    break;
                $row++;
            }
            $row--;
            $col++;
        }
        $counter = 0;
        $this->row = array();
        // check from placed token to bottom left
        while ($row >= 0) {
            if ($col >= 7)
                break;
            // echo json_encode(array($row,$col));
            if ($this->board[$row][$col] == $token) {
                $counter++;
                array_push($this->row, $col, $row);
            } else {
                $counter = 0;
                $this->row = array();
            }
            if ($counter == 4)
                return true;
            $col++;
            $row--;
        }
        return false;
    }
    /**
     * Checks if the piece in the board has made positive diagonal winning move.
     * 
     * @param x column for board, y row for board, token is player or AI game piece identifier
     * @return bool
     */
    function checkPositiveDiagonal($x, $y, $token): bool
    {
        $row = $y;
        $col = $x;
        if ($row == 0 or $col == 0) {
            $col = $x;
        } else {
            for ($col = $x; $col >= 0; $col--) {
                if ($row < 0)
                    break;
                $row--;
            }
            $row++;
            $col++;
        }
        $counter = 0;
        $this->row = array();
        // check from placed token to bottom right
        while ($row < 6) {
            if ($col >= 7)
                break;
            if ($this->board[$row][$col] == $token) {
                $counter++;
                array_push($this->row, $col, $row);
            } else {
                $counter = 0;
                $this->row = array();
            }
            if ($counter == 4)
                return true;
            $col++;
            $row++;
        }
        $this->row = array();
        return false;
    }
    /**
     * Checks if top row of the board is full.
     * 
     * @return bool
     */
    public function checkDraw(): bool
    {
        for ($i = 0; $i < WIDTH; $i++) {
            if ($this->board[0][$i] == 0)
                return false;
        }
        return true;
    }
}
