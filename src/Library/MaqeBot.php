<?php

namespace App\Library;

use App\Interfaces\BotInterface;
use App\Interfaces\BotStateInterface;
use App\Interfaces\HandlerInterface;
use App\Library\Support\MaqeIterator;

class MaqeBot implements BotInterface
{
    /**
     * @var MaqeIterator
     */
    protected MaqeIterator $commandIterator;

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
        $this->commandIterator = $handler->getCommandsIterator();
        foreach ($this->commandIterator as $key => $value) {

            if ($this->commandIterator->valid()) {
                $steps = 1;
                $this->commandIterator->next();
                if ($this->commandIterator->valid()) {
                    $steps = is_numeric($this->commandIterator->current()) ? (int)$this->commandIterator->current() : 1;
                }

                $this->runnerInterpreter->execute($value, $steps);
                $this->commandIterator->seek($key);
            }

        }

        return $this->runnerInterpreter->getBotState();
    }
}
