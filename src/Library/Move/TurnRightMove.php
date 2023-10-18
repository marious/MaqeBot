<?php

namespace App\Library\Move;

use App\Library\Enums\DirectionEnum;

class TurnRightMove extends AbstractMove
{

    /**
     * Get Current Direction index
     *
     * @param int $steps
     * @return void
     */
    public function move(int $steps): void
    {
        /**
         * Algorithm to calculate a new index within a cycle range (0 to 3) representing[North, East, South, West]
         * It ensures the new index remains in valid range.
         * $currentIndex: The variable of current index within the range (0, 3)
         * $steps: represents the number of steps by which you want to change the current index.
         * % 4 the modulo calculate the remainder. the operation applied with 4 to get the new index
         * within the valid range 0 to 3
         */
        if (DirectionEnum::tryFrom($this->botState->getDirection())) {
            $currentIndex = array_search($this->botState->getDirection(), $this->directions, true);
            $newIndex = ($currentIndex + $steps) % count($this->directions);
            $newDirection = $this->directions[$newIndex];
            $this->botState->setDirection($newDirection);
        }
    }
}
