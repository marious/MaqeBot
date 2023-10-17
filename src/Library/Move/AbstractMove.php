<?php

namespace App\Library\Move;

use App\Interfaces\BotStateInterface;
use App\Interfaces\Movable;
use App\Library\Enums\DirectionEnum;

abstract class AbstractMove implements Movable
{
    /**
     * Array Of Available Directions
     *
     * @var array
     */
    protected array $directions;

    /**
     * @param BotStateInterface $botState
     */
    public function __construct(protected BotStateInterface $botState)
    {
        $this->directions = [
            DirectionEnum::NORTH->value,
            DirectionEnum::EAST->value,
            DirectionEnum::SOUTH->value,
            DirectionEnum::WEST->value
        ];
    }

    /**
     * @param int $steps
     * @return void
     */
    abstract public function move(int $steps): void;
}
