<?php

namespace App\Interfaces;

interface RunnerInterpreterInterface
{

    /**
     * @param BotStateInterface $botState
     */
    public function __construct(BotStateInterface $botState);

    /**
     * @return BotStateInterface
     */
    public function getBotState(): BotStateInterface;

    /**
     * @param string $command
     * @param MovableInterface $moveStrategy
     * @return void
     */
    public function addMoveStrategy(string $command, MovableInterface $moveStrategy): void;

    /**
     * @param string $command
     * @param int $steps
     * @return void
     */
    public function execute(string $command, int $steps): void;

    /**
     * @param string $command
     * @return MovableInterface
     */
    public function getMoveStrategy(string $command): MovableInterface;
}
