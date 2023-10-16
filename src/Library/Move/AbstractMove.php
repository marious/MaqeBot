<?php

namespace App\Library\Move;

use App\Interfaces\BotStateInterface;
use App\Interfaces\Movable;

abstract class AbstractMove implements Movable
{
    /**
     * Array Of Available Directions
     *
     * @var array|string[]
     */
    protected array $directions = ['North', 'East', 'South', 'West'];

    /**
     * @param BotStateInterface $botState
     */
    public function __construct(protected BotStateInterface $botState)
    {
    }

    /**
     * @param int $steps
     * @return void
     */
    abstract public function move(int $steps): void;
}