<?php

namespace App\Services;

use App\Exceptions\InvalidCommandException;
use App\Interfaces\HandlerInterface;
use App\Interfaces\ValidatorInterface;
use App\Library\Support\CommandPrepare;
use App\Library\Support\MaqeIterator;

class Handler implements HandlerInterface
{
    /**
     * @var string
     */
    protected string $command;

    /**
     * @var CommandPrepare
     */
    protected CommandPrepare $commandPrepare;

    /**
     * @var ValidatorInterface[]
     */
    protected array $validations = [];

    /**
     * @var MaqeIterator
     */
    protected MaqeIterator $commandsIterator;


    /**
     * @param string $command
     * @param CommandPrepare $commandPrepare
     */
    public function __construct(string $command, CommandPrepare $commandPrepare)
    {
        $this->command = $command;
        $this->commandPrepare = $commandPrepare;
    }


    /**
     * @return HandlerInterface
     * @throws InvalidCommandException
     */
    public function handle(): HandlerInterface
    {
        $this->validateCommand($this->command);
        $this->commandsIterator = $this->commandPrepare->commandToIterator($this->command);
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
     * @return MaqeIterator
     */
    public function getCommandsIterator(): MaqeIterator
    {
        return $this->commandsIterator;
    }

    /**
     * @param ValidatorInterface $validator
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validations[] = $validator;
    }
}
