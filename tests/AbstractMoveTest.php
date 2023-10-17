<?php

use App\Exceptions\InvalidCommandException;
use App\Library\Enums\DirectionEnum;
use App\Library\MaqeBotState;
use App\Library\Move\WalkForwardMove;
use PHPUnit\Framework\TestCase;

class AbstractMoveTest extends TestCase
{
    public function testMoveNorth(): void
    {
        $botState = new MaqeBotState();
        $move = new  WalkForwardMove($botState);
        $move->move(1);
        $this->assertEquals(DirectionEnum::NORTH->value, $botState->getDirection());
        $this->assertEquals(1, $botState->getY());
    }

    public function testMoveEast(): void
    {
        $botState = new MaqeBotState();
        $botState->setDirection(DirectionEnum::EAST->value);
        $move = new WalkForwardMove($botState);
        $move->move(1);
        $this->assertEquals(DirectionEnum::EAST->value, $botState->getDirection());
        $this->assertEquals(1, $botState->getX());
    }

    public function testMoveWest(): void
    {
        $botState = new MaqeBotState();
        $botState->setDirection(DirectionEnum::WEST->value);
        $move = new WalkForwardMove($botState);
        $move->move(1);
        $this->assertEquals(DirectionEnum::WEST->value, $botState->getDirection());
        $this->assertEquals(-1, $botState->getX());
    }

    public function testExceptionForMove(): void
    {
        $botState = new MaqeBotState();
        $botState->setDirection('MM');
        $move = new  WalkForwardMove($botState);
        $this->expectException(InvalidCommandException::class);
        $move->move(1);
    }

}