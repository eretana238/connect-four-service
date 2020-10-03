<?php
/**
 * Helps the player make a move
 * 
 * @author Esteban Retana
 */
require_once dirname(__DIR__)."/Models/Game.php";
require_once dirname(__DIR__)."/Models/Board.php";

class Move {
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

   private function __construct($slot, $isWin = false, $isDraw = false, $row = array()) {
      $this->slot = $slot;
      if ($isWin) $this->isWin = $isWin;
      if ($isDraw) $this->isDraw = $isDraw;
      if ($row) $this->row = $row;
   }
   
   public function createResponse($playerMove, $opponentMove = null): json {
      $result = array("response" => true, "ack_move" => $playerMove);
      if ($opponentMove != null) { $result["move"] = $opponentMove; }
      return json_encode($result);
   }
   
   public function makePlayerMove($slot, $isWin, $isDraw, $row) {
      return new Move($slot, $isWin, $isDraw, $row);
   }

   public function makeOpponentMove($slot, $isWin, $isDraw, $row) {
      return new Move($slot, $isWin, $isDraw, $row);
   }

   public function getIsWin(): boolean {
      return $this->isWin;
   }
   
   public function getIsDraw(): boolean {
      return $this->isDraw;
   }

   public function getRow(): boolean {
      return $this->row;
   }
}
?>