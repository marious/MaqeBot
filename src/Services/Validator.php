<?php

namespace App\Services;

use App\Interfaces\ValidatorInterface;

class Validator implements ValidatorInterface
{

    /**
     * Regex pattern validate string which string contains only (R OR L or W) and W followed by integer value.
     * ex: RW5, LLRRW5
     * @param string $value
     * @return bool
     */
    public function validate(string $value): bool
    {
        return preg_match('/^(R|L|W\d+)+$/', $value) === 1;
    }
}