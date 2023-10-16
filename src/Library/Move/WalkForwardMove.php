<?php

namespace App\Library\Move;

use App\Interfaces\BotStateInterface;
use App\Interfaces\Movable;

class WalkForwardMove implements Movable
{

    public function move(BotStateInterface $botState, int $rounds)
    {
        $currentDirection = $botState->getDirection();

        switch ($currentDirection) {
            case 'North':
                $botState->setY($botState->getY() + $rounds);
                break;
            case 'East':
                $botState->setX($botState->getX() + $rounds);
                break;
            case 'South':
                $botState->setY($botState->getY() - $rounds);
                break;
            case 'West':
                $botState->setX($botState->getX() - $rounds);
                break;
        }
    }
}