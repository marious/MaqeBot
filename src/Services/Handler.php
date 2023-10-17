<?php

namespace App\Services;

use App\Exceptions\InvalidCommandException;
use App\Interfaces\HandlerInterface;
use App\Interfaces\ValidatorInterface;

class Handler implements HandlerInterface
{
    /**
     * @var string
     */
    protected string $command;

    /**
     * @var ValidatorInterface[]
     */
    protected array $validations = [];

    /**
     * Array that hold Commands for movement
     *
     * @var array
     */
    protected array $commandArr;

    /**
     * @param string $command
     */
    public function __construct(string $command)
    {
        $this->command = $command;
    }


    /**
     * @return HandlerInterface
     * @throws InvalidCommandException
     */
    public function handle(): HandlerInterface
    {
        $this->validateCommand($this->command);
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
     * Array of commands like ['R', 'W', 33]
     * @return array
     */
    public function getCommandArr(): array
    {
        return $this->commandArr;
    }

    /**
     * @param ValidatorInterface $validator
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validations[] = $validator;
    }

    /**
     * @param string $commands
     * @return array
     */
    private function parseCommands(string $commands): array
    {
        $pattern = '/(R|L|W\d+)/';
        /**
         * This will split the string to match our movement mechanism for example if string like 'LLW99'
         * It will b ['L', 'L', 'W99']
         */
        preg_match_all($pattern, $commands, $matches);
        $parsedCommands = [];

        /**
         * The goal of this is to separate number from W ex you have this ['L', 'L', 'W99']
         * so it will be after this loop ['L', 'L', 'W', 99]
         */
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
