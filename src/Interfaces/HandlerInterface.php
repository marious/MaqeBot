<?php

namespace App\Interfaces;

interface HandlerInterface
{
    public function handle(): HandlerInterface;
}