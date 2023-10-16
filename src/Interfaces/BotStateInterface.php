<?php

namespace App\Interfaces;

interface BotStateInterface
{
    /**
     * @return int
     */
    public function getX(): int;

    /**
     * @return int
     */
    public function getY(): int;

    /**
     * @return string
     */
    public function getDirection(): string;

    /**
     * @param int $x
     * @return void
     */
    public function setX(int $x): void;

    /**
     * @param int $y
     * @return void
     */
    public function setY(int $y): void;

    /**
     * @param string $direction
     * @return void
     */
    public function setDirection(string $direction): void;
}