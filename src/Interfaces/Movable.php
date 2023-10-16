<?php
namespace App\Interfaces;

interface Movable
{
    public function move(BotStateInterface $botState, int $rounds);
}