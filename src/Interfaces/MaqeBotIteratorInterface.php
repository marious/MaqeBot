<?php

namespace App\Interfaces;

use App\Library\Support\DataSource;

interface MaqeBotIteratorInterface
{
    /**
     * @param DataSource $dataSource
     * @return void
     */
    public function setData(DataSource $dataSource): void;

    /**
     * @param $key
     * @return void
     */
    public function seek($key): void;
}
