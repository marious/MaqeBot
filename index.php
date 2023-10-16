<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Exceptions\InvalidCommandException;
use App\Library\MaqeBot;
use App\Library\MaqeBotState;
use App\Library\RunnerInterpreter;
use App\Services\Handler;
use App\Services\Validator;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $command = 'RW5';

    $handler = new Handler($command, [new Validator()]);

    $botState = new MaqeBotState();

    $bot = new MaqeBot($botState, new RunnerInterpreter($botState));
    $state = $bot->run($handler->handle());
    $text = 'X: ' . $state->getX() . ' Y: ' . $state->getY() . ' Direction: ' . $state->getDirection() . PHP_EOL;
    echo $text;
} catch (InvalidCommandException $e) {
    echo $e->getMessage();
}
