<?php

namespace App\Interfaces;

interface HandlerInterface
{
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
}