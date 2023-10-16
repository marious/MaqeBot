<?php

namespace App\Library\Move;

use App\Library\Enums\DirectionEnum;

class WalkForwardMove extends AbstractMove
{

    /**
     * @param int $steps
     * @return void
     */
    public function move(int $steps): void
    {
        switch ($this->botState->getDirection()) {
            case DirectionEnum::NORTH->value:
                $this->botState->setY($this->botState->getY() + $steps);
                break;
            case DirectionEnum::EAST->value:
                $this->botState->setX($this->botState->getX() + $steps);
                break;
            case DirectionEnum::SOUTH->value:
                $this->botState->setY($this->botState->getY() - $steps);
                break;
            case DirectionEnum::WEST->value:
                $this->botState->setX($this->botState->getX() - $steps);
                break;
        }
    }
}