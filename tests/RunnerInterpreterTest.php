<?php

use App\Exceptions\InvalidRunnerStrategyException;
use App\Library\MaqeBotState;
use App\Library\Move\WalkForwardMove;
use App\Library\RunnerInterpreter;
use PHPUnit\Framework\TestCase;

class RunnerInterpreterTest extends TestCase
{
    public function testAddMoveStrategy(): void
    {
        $botState = new MaqeBotState();
        $interpreter = new RunnerInterpreter($botState);
        $moveStrategy = new WalkForwardMove($botState);
        $interpreter->addMoveStrategy('W', $moveStrategy);
        $this->assertEquals($moveStrategy, $interpreter->getMoveStrategy('W'));
    }

    public function testMoveStrategyException(): void
    {
        $botState = new MaqeBotState();
        $interpreter = new RunnerInterpreter($botState);
        $moveStrategy = new WalkForwardMove($botState);

        $this->expectException(InvalidRunnerStrategyException::class);

        $interpreter->getMoveStrategy('M', $moveStrategy);
    }
}