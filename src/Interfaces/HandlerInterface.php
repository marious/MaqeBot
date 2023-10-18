<?php

namespace App\Interfaces;

use App\Library\Support\CommandPrepare;
use App\Library\Support\MaqeIterator;
use ArrayObject;

interface HandlerInterface
{

    /**
     * @param string $command
     * @param CommandPrepare $commandPrepare
     */
    public function __construct(string $command, CommandPrepare $commandPrepare);

    /**
     * @return HandlerInterface
     */
    public function handle(): HandlerInterface;

    /**
     * @param string $command
     * @return void
     */
    public function validateCommand(string $command): void;

    /**
     * @return MaqeIterator
     */
    public function getCommandsIterator(): MaqeIterator;

    /**
     * @param ValidatorInterface $validator
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void;
}