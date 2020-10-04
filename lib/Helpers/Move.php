<?php

/**
 * Helps the player make a move
 * 
 * @author Esteban Retana
 */
require_once dirname(__DIR__) . "/Models/Game.php";
require_once dirname(__DIR__) . "/Models/Board.php";

class Move
{
   /**
    * @var int
    */
   private $slot;
   /**
    * @var boolean
    */
   private $isWin;
   /**
    * @var boolean
    */
   private $isDraw;
   /**
    * @var array
    */
   private $row;
   /**
    * Constructor for Move
    */
   private function __construct($slot, $isWin = false, $isDraw = false, $row = array())
   {
      $this->slot = $slot;
      if ($isWin) $this->isWin = $isWin;
      if ($isDraw) $this->isDraw = $isDraw;
      if ($row) $this->row = $row;
   }
   /**
    * Generates response for both playermove and opponent move. Obtains the moves current state.
    * 
    * @param playerMove instance of Move, opponentMove instance of Move
    * @return json data
    */
   public function createResponse($playerMove, $opponentMove = null): string
   {
      $result = array("response" => true, "ack_move" => $playerMove);
      if ($opponentMove != null) {
         $result["move"] = $opponentMove;
      }
      return json_encode($result);
   }
   /**
    * Creates an instance of Move to check the current status of the move done by the player.
    * 
    * @param slot column of board, isWin checks if move caused a win of the game, isdraw checks if the last move
    * has been done then it is a draw, row is an array representing the winning row (represented by x1,y1,x2,y2...) 
    * @return Move instance of player
    */
   static function makePlayerMove($slot, $isWin, $isDraw, $row)
   {
      return new Move($slot, $isWin, $isDraw, $row);
   }
   /**
    * Creates an instance of Move to check the current status of the move done by the AI opponent
    *
    * @param slot column of board, isWin checks if move caused a win of the game, isdraw checks if the last move
    * has been done then it is a draw, row is an array representing the winning row (represented by x1,y1,x2,y2...) 
    * @return Move instance of player
    */
   static function makeOpponentMove($slot, $isWin, $isDraw, $row)
   {
      return new Move($slot, $isWin, $isDraw, $row);
   }
   /**
    * Getters for isWin, isDraw, row

    * @return isWin, isDraw, row
    */
   public function getIsWin(): bool
   {
      return $this->isWin;
   }

   public function getIsDraw(): bool
   {
      return $this->isDraw;
   }

   public function getRow(): array
   {
      return $this->row;
   }
}
