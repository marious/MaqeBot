<?php

namespace App\Interfaces;

interface ValidatorInterface
{
    public function validate(string $value): bool;
}