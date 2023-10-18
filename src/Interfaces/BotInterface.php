<?php

namespace App\Interfaces;

use App\Library\RunnerInterpreter;

interface BotInterface
{
    /**
     * @param RunnerInterpreter $runnerInterpreter
     */
    public function __construct(RunnerInterpreter $runnerInterpreter);

    /**
     * @param HandlerInterface $handler
     * @return BotStateInterface
     */
    public function run(HandlerInterface $handler): BotStateInterface;
}
