<?php

use App\Interfaces\BotStateInterface;
use App\Library\Enums\DirectionEnum;
use App\Library\Enums\MovableEnum;
use App\Library\MaqeBot;
use App\Library\MaqeBotState;
use App\Library\Move\TurnLeftMove;
use App\Library\Move\TurnRightMove;
use App\Library\Move\WalkForwardMove;
use App\Library\RunnerInterpreter;
use App\Services\Handler;
use App\Services\Validator;
use PHPUnit\Framework\TestCase;

class MaqeBotTest extends TestCase
{
    public function testMovementCaseOne(): void
    {
        $botState = $this->createBotAndRun('RW15RW1');

        $this->assertEquals(15, $botState->getX());
        $this->assertEquals(-1, $botState->getY());
        $this->assertEquals(DirectionEnum::SOUTH->value, $botState->getDirection());
    }

    public function testMovementCaseTwo(): void
    {
        $botState = $this->createBotAndRun('W5RW5RW2RW1R');

        $this->assertEquals(4, $botState->getX());
        $this->assertEquals(3, $botState->getY());
        $this->assertEquals(DirectionEnum::NORTH->value, $botState->getDirection());
    }

    public function testMovementCaseThree(): void
    {
        $botState = $this->createBotAndRun('RRW11RLLW19RRW12LW1');

        $this->assertEquals(7, $botState->getX());
        $this->assertEquals(-12, $botState->getY());
        $this->assertEquals(DirectionEnum::SOUTH->value, $botState->getDirection());
    }

    public function testMovementCaseFour(): void
    {
        $botState = $this->createBotAndRun('LLW100W50RW200W10');

        $this->assertEquals(-210, $botState->getX());
        $this->assertEquals(-150, $botState->getY());
        $this->assertEquals(DirectionEnum::WEST->value, $botState->getDirection());
    }

    public function testMovementCaseFive(): void
    {
        $botState = $this->createBotAndRun('LLLLLW99RRRRRW88LLLRL');

        $this->assertEquals(-99, $botState->getX());
        $this->assertEquals(88, $botState->getY());
        $this->assertEquals(DirectionEnum::EAST->value, $botState->getDirection());
    }

    public function testMovementCaseSix(): void
    {
        $botState = $this->createBotAndRun('W55555RW555555W444444W1');

        $this->assertEquals(1000000, $botState->getX());
        $this->assertEquals(55555, $botState->getY());
        $this->assertEquals(DirectionEnum::EAST->value, $botState->getDirection());
    }

    private function createBotAndRun($command): BotStateInterface
    {
        $handler = new Handler($command);
        $handler->setValidator(new Validator());
        $botState = new MaqeBotState();
        $runnerInterpreter = new RunnerInterpreter($botState);
        $bot = new MaqeBot($runnerInterpreter);
        $runnerInterpreter->addMoveStrategy(MovableEnum::L->value, new TurnLeftMove($botState));
        $runnerInterpreter->addMoveStrategy(MovableEnum::R->value, new TurnRightMove($botState));
        $runnerInterpreter->addMoveStrategy(MovableEnum::W->value, new WalkForwardMove($botState));
        return $bot->run($handler->handle());
    }

}