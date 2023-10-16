<?php
namespace App\Library;

use App\Interfaces\BotInterface;
use App\Interfaces\BotStateInterface;
use App\Interfaces\HandlerInterface;

class MaqeBot implements BotInterface
{
    /**
     * @param BotStateInterface $bootState
     * @param RunnerInterpreter $runnerInterpreter
     */
    public function __construct(protected BotStateInterface $bootState, protected RunnerInterpreter $runnerInterpreter)
    {
    }

    /**
     * @param HandlerInterface $run
     * @return BotStateInterface
     */
    public function run(HandlerInterface $run)
    {
        foreach ($run->getCommandArr() as $key => $value) {
            $rounds = $this->getStepsCount($run->getCommandArr(), $key);
            $this->runnerInterpreter->execute($value, $rounds);
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
        $rounds = 1;
        if (isset($command[$key + 1]) && is_numeric($command[$key + 1])) {
            $rounds = $command[$key + 1];
        }
        return $rounds;
    }
}