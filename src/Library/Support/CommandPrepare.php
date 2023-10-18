<?php

namespace App\Library\Support;

use App\Interfaces\CommandPrepareInterface;
use App\Interfaces\MaqeBotIteratorInterface;

class CommandPrepare implements CommandPrepareInterface
{
    /**
     * @param DataSource $dataSource
     * @param MaqeBotIteratorInterface $iterator
     */
    public function __construct(protected DataSource $dataSource, protected MaqeBotIteratorInterface $iterator)
    {
    }

    /**
     * @param string $commands
     * @return MaqeIterator
     */
    public function commandToIterator(string $commands): MaqeIterator
    {
        $this->setDataInIterator($this->parseCommands($commands));
        return $this->iterator;
    }

    /**
     * @param array $commandsArr
     * @return void
     */
    private function setDataInIterator(array $commandsArr): void
    {
        foreach ($commandsArr as $item) {
            $this->dataSource->addItem($item);
        }
        $this->iterator->setData($this->dataSource);
    }

    /**
     * @param string $commands
     * @return array
     */
    private function parseCommands(string $commands): array
    {
        $pattern = '/(R|L|W\d+)/';
        /**
         * This will split the string to match our movement mechanism for example if string like 'LLW99'
         * It will b ['L', 'L', 'W99']
         */
        preg_match_all($pattern, $commands, $matches);
        $parsedCommands = [];

        /**
         * The goal of this is to separate number from W ex you have this ['L', 'L', 'W99']
         * so it will be after this loop ['L', 'L', 'W', 99]
         */
        foreach ($matches[0] as $match) {
            if (preg_match('/^W(\d+)$/', $match, $distanceMatch)) {
                $parsedCommands[] = 'W';
                $parsedCommands[] = (int)$distanceMatch[1];
            } else {
                $parsedCommands[] = $match;
            }
        }

        return $parsedCommands;
    }

}
