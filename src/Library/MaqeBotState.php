<?php

namespace App\Library;

use App\Interfaces\BotStateInterface;
use App\Library\Enums\DirectionEnum;

class MaqeBotState implements BotStateInterface
{
    private int $x;
    private int $y;
    private string $direction;

    /**
     * Initialize MaqeBotState default state.
     */
    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->direction = DirectionEnum::NORTH->value;
    }

    /**
     *
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     *
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param int $x
     * @return void
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * @param int $y
     * @return void
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * @param string $direction
     * @return void
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }
}
