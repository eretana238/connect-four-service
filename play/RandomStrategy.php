<?php

/**
 * RandomStrategy is part of the AI strategy model
 * 
 * @author Esteban Retana
 */
require_once __DIR__ . "/MoveStrategy.php";

class RandomStrategy extends MoveStrategy
{
    /**
     * AI picks random slot that is not full
     * 
     * @return columnIndex
     */
    public function pickSlot(): int
    {
        if ($board->isFull)
            return null;
        $randColumn = rand(0, 6);
        for ($i = $randColumn; $i < $randColumn + 6; $i++) {
            if ($this->board->board[0][$i % 7] == 0)
                return $i;
        }
    }
}
