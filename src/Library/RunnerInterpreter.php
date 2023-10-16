<?php

namespace App\Library;

use App\Interfaces\BotStateInterface;
use App\Interfaces\RunnerInterpreterInterface;
use App\Library\Enums\MovableEnum;
use App\Library\Move\TurnLeftMove;
use App\Library\Move\TurnRightMove;
use App\Library\Move\WalkForwardMove;

class RunnerInterpreter implements RunnerInterpreterInterface
{
    private array $strategies;

    /**
     * @param BotStateInterface $botState
     */
    public function __construct(protected BotStateInterface $botState)
    {
        $this->strategies = [
            MovableEnum::L->value => new TurnLeftMove(),
            MovableEnum::R->value => new TurnRightMove(),
            MovableEnum::W->value => new WalkForwardMove(),
        ];
    }


    /**
     * @param string $command
     * @param int $steps
     * @return void
     */
    public function execute(string $command, int $steps): void
    {
        if (array_key_exists($command, $this->strategies)) {
            $this->strategies[$command]->move($this->botState, $steps);
        }
    }
}