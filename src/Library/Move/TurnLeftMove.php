<?php

namespace App\Library\Move;

use App\Interfaces\BotStateInterface;
use App\Interfaces\Movable;
use App\Library\Enums\DirectionEnum;

class TurnLeftMove extends Move implements Movable
{

    public function move(BotStateInterface $botState, int $steps): void
    {
        if (DirectionEnum::tryFrom($botState->getDirection())) {
            $currentIndex = array_search($botState->getDirection(), $this->directions, true);
            $newIndex = ($currentIndex - $steps + 4) % 4;
            $newDirection = $this->directions[$newIndex];
            $botState->setDirection($newDirection);
        }
    }
}