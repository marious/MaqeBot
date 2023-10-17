<?php

namespace App\Interfaces;

interface Movable
{
    /**
     * @param BotStateInterface $botState
     */
    public function __construct(BotStateInterface $botState);

    /**
     * @param int $steps
     * @return void
     */
    public function move(int $steps): void;
}
