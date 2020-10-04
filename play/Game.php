<?php

/**
 * Game Model
 * 
 * @author Esteban Retana
 */
include_once __DIR__ . "/Board.php";
include_once __DIR__ . "/MoveStrategy.php";
include_once __DIR__ . "/RandomStrategy.php";
include_once __DIR__ . "/SmartStrategy.php";
include_once __DIR__ . "/Move.php";

class Game
{
    /**
     * @var Board instance
     */
    public $board;
    /**
     * @var MoveStrategy instance
     */
    public $strategy;

    private $strategyObj;
    /**
     * @var array
     */
    public $strategies;

    function __construct()
    {
        $this->board = new Board();
        $this->strategies = array("Smart", "Random");
    }
    /**
     * Converts json data into a readable a string
     * 
     * @param json obtained from (fake) database
     * @return string
     */
    static function fromJsonString($json): Game
    {
        $obj = json_decode($json); // instance of stdClass
        $strategy = $obj->{"strategy"};
        $board = $obj->{"board"};
        $game = new Game();
        $game->board = Board::fromJson($board);
        $name = $strategy->{"name"};
        $game->strategyObj = $name::fromJson();
        $game->strategyObj->board = $game->board;
        $game->strategy = $game->strategyObj->toJson();
        return $game;
    }
    /**
     * Allow the player to make move. Figures out the placing of the token (where it falls to), 
     * then determines if the move changes the game state to win or to a tie and creates the move
     * instance with some new data.
     * 
     * @param x defines the slot that the player choose to put with game piece.
     * @return Move player instance
     */
    public function makePlayerMove($x): Move
    {
        if ($this->board->isSlotFull($x))
            return null;
        $piece = $this->board->placeToken($x, 1); // piece coordinates x, y
        $isWin = $this->board->checkWin($piece[0],$piece[1], 1);
        $isDraw = $this->board->checkDraw();
        $row = $this->board->row;
        return Move::makePlayerMove($x, $isWin, $isDraw, $row);
    }
    /**
     * Allow the opponent to make a move. Figures out the placing of the token (where it falls to), 
     * then determines if the move changes the game state to win or to a tie and creates the move
     * instance with some new data.
     * 
     * @param none
     * @return Move opponent instance
     */
    public function makeOpponentMove(): Move
    {
        $slot = $this->strategyObj->pickSlot();
        $piece = $this->board->placeToken($slot, 2); // piece coordinates x, y
        $isWin = $this->board->checkWin($piece[0], $piece[1],2);
        $isDraw = $this->board->checkDraw();
        $row = $this->board->row;
        return Move::makeOpponentMove($slot, $isWin, $isDraw, $row);
    }
}
