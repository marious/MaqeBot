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

    public function addMoveStrategy(string $command, AbstractMove $moveStrategy);
}