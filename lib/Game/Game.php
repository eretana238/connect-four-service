<?php
/**
 * Game Model
 * 
 * @author Esteban Retana\
 */
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

    public function makePlayerMove($x, $y): none {

    }
}
