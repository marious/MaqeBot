<?php

namespace App\Library\Move;

use App\Library\Enums\DirectionEnum;

class TurnLeftMove extends AbstractMove
{

    /**
     * @param int $steps
     * @return void
     */
    public function move(int $steps): void
    {
        if (DirectionEnum::tryFrom($this->botState->getDirection())) {
            $currentIndex = array_search($this->botState->getDirection(), $this->directions, true);
            $newIndex = ($currentIndex - $steps + 4) % 4;
            $newDirection = $this->directions[$newIndex];
            $this->botState->setDirection($newDirection);
        }
    }
}