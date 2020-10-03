<?php
/**
 * Game Model
 * 
 * @author Esteban Retana\
 */
require_once __DIR__."/Board.php";
require_once dirname(__DIR__)."/Strategies/RandomStrategy.php";
require_once dirname(__DIR__)."/Strategies/SmartStrategy.php";

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
     * Allow the player to make move
     * 
     * @param x defines the slot that the player choose to put with game piece.
     * @return Move player instance
     */
    public function makePlayerMove($x): Move {
        return Move::makePlayerMove($x);
    }
    /**
     * Allow the opponent to make a move
     * 
     * @param none
     * @return Move opponent instance
     */
    public function makeOpponentMove(): Move {
        return Move::makeOpponentMove();
    }
}