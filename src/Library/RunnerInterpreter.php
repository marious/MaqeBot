<?php

namespace App\Library;

use App\Exceptions\InvalidRunnerStrategyException;
use App\Interfaces\BotStateInterface;
use App\Interfaces\RunnerInterpreterInterface;
use App\Library\Move\AbstractMove;

class RunnerInterpreter implements RunnerInterpreterInterface
{
    /**
     * @var array Available strategies of move algorithms
     */
    private array $strategies;

    /**
     * @param BotStateInterface $botState
     */
    public function __construct(protected BotStateInterface $botState)
    {
        $this->strategies = [];
    }

    /**
     * @return BotStateInterface
     */
    public function getBotState(): BotStateInterface
    {
        return $this->botState;
    }

    /**
     * @param string $command
     * @param AbstractMove $moveStrategy
     * @return void
     */
    public function addMoveStrategy(string $command, AbstractMove $moveStrategy): void
    {
        $this->strategies[$command] = $moveStrategy;
    }

    /**
     * @param string $command
     * @param int $steps
     * @return void
     */
    public function execute(string $command, int $steps): void
    {
        if (array_key_exists($command, $this->strategies)) {
            $this->strategies[$command]->move($steps);
        }
    }

    /**
     * @param string $command
     * @return mixed
     * @throws InvalidRunnerStrategyException
     */
    public function getMoveStrategy(string $command): AbstractMove
    {
        return $this->strategies[$command] ?? throw new InvalidRunnerStrategyException();
    }
}
