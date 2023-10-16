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

    public function __construct(string $command, array $validations)
    {
        $this->validations = $validations;
        $this->validateCommand($command);
    }


    public function handle(): HandlerInterface
    {
        $this->commandArr = $this->parseCommands($this->command);
         return $this;
    }

    public function validateCommand(string $command): void
    {
        foreach ($this->validations as $validation) {
            if (!$validation->validate($command)) {
                throw new InvalidCommandException('Invalid Command');
            }
        }

        $this->command = $command;
    }

    public function getCommandArr(): array
    {
        return $this->commandArr;
    }

    private function parseCommands(string $commands)
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
