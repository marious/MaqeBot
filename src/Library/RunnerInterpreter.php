<?php

namespace App\Library;

use App\Interfaces\BotStateInterface;
use App\Interfaces\RunnerInterpreterInterface;
use App\Library\Move\TurnLeftMove;
use App\Library\Move\TurnRightMove;
use App\Library\Move\WalkBackwardMove;
use App\Library\Move\WalkForwardMove;

class RunnerInterpreter implements RunnerInterpreterInterface
{
    public function __construct(protected BotStateInterface $botState)
    {
    }


    public function execute(string $command, int $rounds)
    {
        switch ($command) {
            case 'R':
                (new TurnRightMove())->move($this->botState, $rounds);
                break;
            case 'L':
                (new TurnLeftMove())->move($this->botState, $rounds);
                break;
            case 'W':
                (new WalkForwardMove())->move($this->botState, $rounds);
                break;
            case 'B':
                (new WalkBackwardMove())->move($this->botState, $rounds);
                break;
        }
    }
}