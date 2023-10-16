<?php

namespace App\Interfaces;

interface RunnerInterpreterInterface
{
    /**
     * @param string $command
     * @param int $steps
     * @return mixed
     */
    public function execute(string $command, int $steps);
}
