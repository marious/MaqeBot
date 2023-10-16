<?php

namespace App\Library\Move;

use App\Interfaces\BotStateInterface;
use App\Interfaces\Movable;
use App\Library\Enums\DirectionEnum;

class WalkBackwardMove implements Movable
{

    /**
     * @param BotStateInterface $botState
     * @param int $rounds
     * @return void
     */
    public function move(BotStateInterface $botState, int $rounds)
    {
        $currentDirection = $botState->getDirection();

        switch ($currentDirection) {
            case DirectionEnum::NORTH->value:
                $botState->setY($botState->getY() - $rounds);
                break;
            case DirectionEnum::EAST->value:
                $botState->setX($botState->getX() - $rounds);
                break;
            case DirectionEnum::SOUTH:
                $botState->setY($botState->getY() + $rounds);
                break;
            case DirectionEnum::WEST:
                $botState->setX($botState->getX() + $rounds);
                break;
        }
    }
}