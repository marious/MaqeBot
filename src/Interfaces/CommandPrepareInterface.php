<?php

namespace App\Interfaces;

use App\Library\Support\DataSource;
use App\Library\Support\MaqeIterator;

interface CommandPrepareInterface
{
    /**
     * @param DataSource $dataSource
     * @param MaqeBotIteratorInterface $iterator
     */
    public function __construct(DataSource $dataSource, MaqeBotIteratorInterface $iterator);

    /**
     * @param string $commands
     * @return MaqeIterator
     */
    public function commandToIterator(string $commands): MaqeIterator;
}