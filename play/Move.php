<?php

/**
 * Helps the player make a move
 * 
 * @author Esteban Retana
 */

class Move
{
   /**
    * @var int
    */
   public $slot;
   /**
    * @var boolean
    */
   public $isWin;
   /**
    * @var boolean
    */
   public $isDraw;
   /**
    * @var array
    */
   public $row;
   /**
    * Constructor for Move
    */
   private function __construct($slot, $isWin = false, $isDraw = false, $row = array())
   {
      $this->slot = $slot;
      $this->isWin = $isWin;
      $this->isDraw = $isDraw;
      $this->row = $row;
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
}
