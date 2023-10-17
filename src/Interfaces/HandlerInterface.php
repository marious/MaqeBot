<?php

namespace App\Interfaces;

interface HandlerInterface
{
    /**
     * @param string $command
     */
    public function __construct(string $command);

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
     * @return array
     */
    public function getCommandArr(): array;

    /**
     * @param ValidatorInterface $validator
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void;
}