<?php

namespace App\Library;

use App\Interfaces\BotInterface;
use App\Interfaces\BotStateInterface;
use App\Interfaces\HandlerInterface;
use App\Library\Move\AbstractMove;

class MaqeBot implements BotInterface
{
    /**
     * @param RunnerInterpreter $runnerInterpreter
     */
    public function __construct(protected RunnerInterpreter $runnerInterpreter)
    {
    }

    /**
     * @param HandlerInterface $handler
     * @return BotStateInterface
     */
    public function run(HandlerInterface $handler): BotStateInterface
    {
        foreach ($handler->getCommandArr() as $key => $value) {
            $steps = $this->getStepsCount($handler->getCommandArr(), $key);
            $this->runnerInterpreter->execute($value, $steps);
        }
        return $this->runnerInterpreter->getBotState();
    }


    /**
     * @param string $command
     * @param AbstractMove $moveStrategy
     * @return void
     */
    public function addMoveStrategy(string $command, AbstractMove $moveStrategy): void
    {
        $this->runnerInterpreter->addMoveStrategy($command, $moveStrategy);
    }

    /**
     * Get count of steps to move
     *
     * @param array $command
     * @param int $key
     * @return int
     */
    private function getStepsCount(array $command, int $key): int
    {
        $steps = 1;
        if (isset($command[$key + 1]) && is_numeric($command[$key + 1])) {
            $steps = $command[$key + 1];
        }
        return $steps;
    }
}