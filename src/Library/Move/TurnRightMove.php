<?php

namespace App\Library\Move;

use App\Interfaces\BotStateInterface;
use App\Interfaces\Movable;
use App\Library\Enums\DirectionEnum;

class TurnRightMove implements Movable
{


    public function move(BotStateInterface $botState, int $rounds)
    {
        $directions = ['North', 'East', 'South', 'West'];

        if (DirectionEnum::tryFrom($botState->getDirection())) {
            $currentIndex = array_search($botState->getDirection(), $directions);
            $newIndex = ($currentIndex + $rounds) % 4;
            $newDirection = $directions[$newIndex];
            $botState->setDirection($newDirection);
        }
    }
}