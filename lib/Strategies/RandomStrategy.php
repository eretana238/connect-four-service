<?php
/**
 * RandomStrategy is part of the AI strategy model
 * 
 * @author Esteban Retana
 */
class RandomStrategy extends MoveStrategy  {
    /**
     * AI picks random slot that is not full
     * 
     * @return columnIndex
     */
    public function pickSlot() {
        if ($isBoardFull)
            return null;
        $randColumn = rand(0,7);
        for ($i = $randColumn; $i < $i + 7; $i++) {
            if($this->board[0][$i%7] == 0)
                return $i;
        }
    }
}