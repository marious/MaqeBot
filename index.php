<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Exceptions\InvalidCommandException;
use App\Library\Enums\MovableEnum;
use App\Library\MaqeBot;
use App\Library\MaqeBotState;
use App\Library\Move\TurnLeftMove;
use App\Library\Move\TurnRightMove;
use App\Library\Move\WalkForwardMove;
use App\Library\RunnerInterpreter;
use App\Library\Support\CommandPrepare;
use App\Library\Support\DataSource;
use App\Library\Support\MaqeIterator;
use App\Services\Handler;
use App\Services\Validator;


try {

    if ($argc < 2) {
        echo 'Please Input Your bot command to move ):' . PHP_EOL;
        exit;
    }

    $commandPrepare = new CommandPrepare(new DataSource(), new MaqeIterator());
    $handler = new Handler($argv[1], $commandPrepare);
    $handler->setValidator(new Validator());

    $botState = new MaqeBotState();

    $runnerInterpreter = new RunnerInterpreter($botState);

    $bot = new MaqeBot($runnerInterpreter);

    $runnerInterpreter->addMoveStrategy(MovableEnum::L->value, new TurnLeftMove($botState));
    $runnerInterpreter->addMoveStrategy(MovableEnum::R->value, new TurnRightMove($botState));
    $runnerInterpreter->addMoveStrategy(MovableEnum::W->value, new WalkForwardMove($botState));

    $state = $bot->run($handler->handle());

    echo 'X: ' . $state->getX() . ' Y: ' . $state->getY() . ' Direction: ' . $state->getDirection() . PHP_EOL;
} catch (InvalidCommandException $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}
