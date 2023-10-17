<?php

use App\Library\Enums\DirectionEnum;
use App\Library\Enums\MovableEnum;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testDirectionEnumValues(): void
    {
        $this->assertEquals('North', DirectionEnum::NORTH->value);
        $this->assertEquals('East', DirectionEnum::EAST->value);
        $this->assertEquals('South', DirectionEnum::SOUTH->value);
        $this->assertEquals('West', DirectionEnum::WEST->value);
    }

    public function testMovableEnumValues(): void
    {
        $this->assertEquals('L', MovableEnum::L->value);
        $this->assertEquals('R', MovableEnum::R->value);
        $this->assertEquals('W', MovableEnum::W->value);
    }
}
