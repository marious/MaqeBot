<?php

use App\Exceptions\InvalidCommandException;
use App\Services\Handler;
use App\Services\Validator;
use PHPUnit\Framework\TestCase;

class HandlerTest extends TestCase
{
    public function testValidCommand(): void
    {
        $validator = new Validator();
        $handler = new Handler('RW5LW3');
        $handler->setValidator($validator);
        $handler->handle();
        $this->assertEquals(['R', 'W', 5, 'L', 'W', 3], $handler->getCommandArr());
    }

    public function testInvalidCommand(): void
    {
        $handler = new Handler('INVALID_COMMAND');
        $handler->setValidator(new Validator());
        $this->expectException(InvalidCommandException::class);
        $handler->handle();
    }
}