<?php

namespace App\Interfaces;

use App\Library\Move\AbstractMove;

interface RunnerInterpreterInterface
{

    /**
     * @return BotStateInterface
     */
    public function getBotState(): BotStateInterface;

    /**
     * @param string $command
     * @param AbstractMove $moveStrategy
     * @return void
     */
    public function addMoveStrategy(string $command, AbstractMove $moveStrategy): void;

    /**
     * @param string $command
     * @param int $steps
     * @return void
     */
    public function execute(string $command, int $steps): void;

    /**
     * @param string $command
     * @return AbstractMove
     */
    public function getMoveStrategy(string $command): AbstractMove;
}
