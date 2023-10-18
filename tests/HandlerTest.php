<?php

use App\Exceptions\InvalidCommandException;
use App\Library\Support\CommandPrepare;
use App\Library\Support\DataSource;
use App\Library\Support\MaqeIterator;
use App\Services\Handler;
use App\Services\Validator;
use PHPUnit\Framework\TestCase;

class HandlerTest extends TestCase
{
    public function testValidCommand(): void
    {
        $validator = new Validator();
        $commandPrepare = new CommandPrepare(new DataSource(), new MaqeIterator());
        $handler = new Handler('RW5LW3', $commandPrepare);
        $handler->setValidator($validator);

        // Define your expected MaqeIterator instance
        $expectedData = ['R', 'W', '5', 'L', 'W', '3'];
        $dataSource = new DataSource();
        foreach ($expectedData as $item) {
            $dataSource->addItem($item);
        }


        $expectedIterator = new MaqeIterator();
        $expectedIterator->setData($dataSource);

        // Mock the CommandParser to return the expected MaqeIterator
        $mockCommandParser = $this->createMock(CommandPrepare::class);
        $mockCommandParser->method('commandToIterator')->willReturn($expectedIterator);

        $handler->handle();
        $this->assertEquals($expectedData, iterator_to_array($handler->getCommandsIterator()));
    }

    public function testInvalidCommand(): void
    {
        $this->expectException(InvalidCommandException::class);

        // Create an invalid test command
        $command = "Invalid Command";
        $commandPrepare = new CommandPrepare(new DataSource(), new MaqeIterator());
        $handler = new Handler($command, $commandPrepare);

        $validator = new Validator();
        $handler->setValidator($validator);

        $handler->handle();
    }

    public function testSeekMethod(): void
    {
        // Create a valid test command
        $command = "RW5LW3";
        $commandPrepare = new CommandPrepare(new DataSource(), new MaqeIterator());
        $handler = new Handler($command, $commandPrepare);

        $validator = new Validator();
        $handler->setValidator($validator);

        $expectedData = ['R', 'W', '5', 'L', 'W', '2'];
        $dataSource = new DataSource();
        foreach ($expectedData as $item) {
            $dataSource->addItem($item);
        }

        $expectedIterator = new MaqeIterator();
        $expectedIterator->setData($dataSource);

        // Mock the CommandParser to return the expected MaqeIterator
        $mockCommandParser = $this->createMock(CommandPrepare::class);
        $mockCommandParser->method('commandToIterator')->willReturn($expectedIterator);

        $handler->handle();

        // Seek to a specific position in the MaqeIterator
        $handler->getCommandsIterator()->seek(1);

        // Check if the current position matches the expected position
        $this->assertEquals(1, $handler->getCommandsIterator()->key());
    }
}