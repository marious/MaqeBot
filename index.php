<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Exceptions\InvalidCommandException;
use App\Library\Enums\MovableEnum;
use App\Library\MaqeBot;
use App\Library\MaqeBotState;
use App\Library\Move\TurnLeftMove;
use App\Library\Move\TurnRightMove;
use App\Library\Move\WalkForwardMove;
use App\Library\RunnerInterpreter;
use App\Services\Handler;
use App\Services\Validator;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $command = 'LLW100W50RW200W10';

    $handler = new Handler($command, [new Validator()]);

    $botState = new MaqeBotState();

    $bot = new MaqeBot(new RunnerInterpreter($botState));

    $bot->addMoveStrategy(MovableEnum::L->value, new TurnLeftMove($botState));
    $bot->addMoveStrategy(MovableEnum::R->value, new TurnRightMove($botState));
    $bot->addMoveStrategy(MovableEnum::W->value, new WalkForwardMove($botState));

    $state = $bot->run($handler->handle());

    $text = 'X: ' . $state->getX() . ' Y: ' . $state->getY() . ' Direction: ' . $state->getDirection() . PHP_EOL;
    echo $text;
} catch (InvalidCommandException $e) {
    echo $e->getMessage();
}
