<?php

namespace App\Services;

use App\Exceptions\InvalidCommandException;
use App\Interfaces\ValidatorInterface;
use Exception;

class Validator implements ValidatorInterface
{

    /**
     * @param string $value
     * @return bool
     */
    public function validate(string $value): bool
    {
        return preg_match('/^(R|L|W\d+)+$/', $value) === 1;
    }
}