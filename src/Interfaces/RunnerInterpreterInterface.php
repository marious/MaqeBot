<?php

namespace App\Interfaces;

interface RunnerInterpreterInterface
{
    /**
     * @param string $command
     * @param int $rounds
     * @return mixed
     */
    public function execute(string $command, int $rounds);
}
