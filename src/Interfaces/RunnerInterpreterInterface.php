<?php

namespace App\Interfaces;

interface RunnerInterpreterInterface
{
    /**
     * @param string $command
     * @param int $steps
     * @return void
     */
    public function execute(string $command, int $steps): void;
}
