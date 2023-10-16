<?php

namespace App\Library;

use App\Interfaces\BotInterface;
use App\Interfaces\BotStateInterface;
use App\Interfaces\HandlerInterface;

class MaqeBot implements BotInterface
{
    /**
     * @param BotStateInterface $botState
     * @param RunnerInterpreter $runnerInterpreter
     */
    public function __construct(protected BotStateInterface $botState, protected RunnerInterpreter $runnerInterpreter)
    {
    }

    /**
     * @param HandlerInterface $run
     * @return BotStateInterface
     */
    public function run(HandlerInterface $run): BotStateInterface
    {
        foreach ($run->getCommandArr() as $key => $value) {
            $steps = $this->getStepsCount($run->getCommandArr(), $key);
            $this->runnerInterpreter->execute($value, $steps);
        }
        return $this->bootState;
    }

    /**
     * @param $command
     * @param $key
     * @return int
     */
    private function getStepsCount($command, $key): int
    {
        $steps = 1;
        if (isset($command[$key + 1]) && is_numeric($command[$key + 1])) {
            $steps = $command[$key + 1];
        }
        return $steps;
    }
}