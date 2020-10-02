<?php
/**
 * Helps the player make a move
 * 
 * @author Esteban Retana
 */
include_once("../Models/Game.php");

class Move {
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

   private function __construct($slot, $isWin = false, $isDraw = false, $row = null) {
      $this->slot = $slot;
      if ($isWin) $this->isWin = $isWin;
      if ($isDraw) $this->isDraw = $isDraw;
      if ($row) $this->row = $row;
   }
   
   function createResponse($playerMove, $opponentMove = null): json {
      $result = array("response" => true, "ack_move" => $playerMove);
      if ($opponentMove != null) { $result["move"] = $opponentMove; }
      return json_encode($result);
   }
   
   function makePlayerMove($slot) {
      
   }

   function makeOpponentMove() {
      
   }

   function isWin($slot): boolean {
   
   }
}
?>