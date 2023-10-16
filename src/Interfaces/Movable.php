<?php

namespace App\Interfaces;

interface Movable
{
    /**
     * @param BotStateInterface $botState
     * @param int $steps
     * @return void
     */
    public function move(BotStateInterface $botState, int $steps): void;
}