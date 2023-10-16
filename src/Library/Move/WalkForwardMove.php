<?php

namespace App\Library\Move;

use App\Interfaces\BotStateInterface;
use App\Interfaces\Movable;
use App\Library\Enums\DirectionEnum;

class WalkForwardMove extends Move implements Movable
{

    /**
     * @param BotStateInterface $botState
     * @param int $steps
     * @return void
     */
    public function move(BotStateInterface $botState, int $steps): void
    {
        $currentDirection = $botState->getDirection();

        switch ($currentDirection) {
            case DirectionEnum::NORTH->value:
                $botState->setY($botState->getY() + $steps);
                break;
            case DirectionEnum::EAST->value:
                $botState->setX($botState->getX() + $steps);
                break;
            case DirectionEnum::SOUTH->value:
                $botState->setY($botState->getY() - $steps);
                break;
            case DirectionEnum::WEST->value:
                $botState->setX($botState->getX() - $steps);
                break;
        }
    }
}