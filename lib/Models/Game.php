<?php
/**
 * Game Model
 * 
 * @author Esteban Retana\
 */
include_once("Board.php");
include_once("../Strategies/RandomStrategy.php");
include_once("../Strategies/SmartStrategy.php");

class Game {
    /**
     * @var array
     */
    public $board;
    /**
     * @var string
     */
    public $strategy;
    /**
     * @var array
     */
    public $strategies;

    function __construct() {
        $this->board = new Board();
    }
    /**
     * Converts json data into a readable a string
     * 
     * @param json obtained from (fake) database
     * @return string
     */
    static function fromJsonString($json): string {
       $obj = json_decode($json); // instance of stdClass
       $strategy = $obj->{'strategy'};
       $board = $obj->{'board'};
       $game = new Game();
       $game->board = Board::fromJson($board);
       $name = $strategy->{'name'};
       $game->strategy = $name::fromJson();
       $game->strategy->board = $game->board;
       return $game;
    }
    /**
     * 
     * @param x defines the slot that the player choose to put with game piece.
     * @return Move instance
     */
    public function makePlayerMove($x) {
        return Move::makePlayerMove($x);
    }
    /**
     * 
     */
    public function makeOpponentMove() {
        return Move::makeOpponentMove();
    }
}
