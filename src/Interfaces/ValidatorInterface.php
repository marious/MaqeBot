<?php

namespace App\Interfaces;

interface ValidatorInterface
{
    /**
     * @param string $value
     * @return bool
     */
    public function validate(string $value): bool;
}