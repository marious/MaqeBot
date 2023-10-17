<?php

namespace App\Interfaces;

use App\Library\Move\AbstractMove;

interface BotInterface
{
    /**
     * @param HandlerInterface $handler
     * @return BotStateInterface
     */
    public function run(HandlerInterface $handler): BotStateInterface;

    /**
     * @param string $command
     * @param AbstractMove $moveStrategy
     * @return void
     */
    public function addMoveStrategy(string $command, AbstractMove $moveStrategy): void;
}