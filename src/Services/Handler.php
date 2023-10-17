<?php

namespace App\Services;

use App\Exceptions\InvalidCommandException;
use App\Interfaces\HandlerInterface;

class Handler implements HandlerInterface
{
    /**
     * @var string
     */
    protected string $command;
    protected array $validations;

    protected array $commandArr;

    /**
     * @param string $command
     * @param array $validations
     * @throws InvalidCommandException
     */
    public function __construct(string $command, array $validations)
    {
        $this->validations = $validations;
        $this->validateCommand($command);
        $this->handle();
    }


    /**
     * @return HandlerInterface
     */
    public function handle(): HandlerInterface
    {
        $this->commandArr = $this->parseCommands($this->command);
        return $this;
    }

    /**
     * @param string $command
     * @return void
     * @throws InvalidCommandException
     */
    public function validateCommand(string $command): void
    {
        foreach ($this->validations as $validation) {
            if (!$validation->validate($command)) {
                throw new InvalidCommandException('Invalid Command');
            }
        }

        $this->command = $command;
    }

    /**
     * @return array
     */
    public function getCommandArr(): array
    {
        return $this->commandArr;
    }

    /**
     * @param string $commands
     * @return array
     */
    private function parseCommands(string $commands): array
    {
        $pattern = '/(R|L|W\d+)/';
        preg_match_all($pattern, $commands, $matches);
        $parsedCommands = [];

        foreach ($matches[0] as $match) {
            if (preg_match('/^W(\d+)$/', $match, $distanceMatch)) {
                $parsedCommands[] = 'W';
                $parsedCommands[] = (int)$distanceMatch[1];
            } else {
                $parsedCommands[] = $match;
            }
        }

        return $parsedCommands;
    }
}
