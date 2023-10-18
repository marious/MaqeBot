<?php

namespace App\Interfaces;

use App\Exceptions\MissingDataSourceException;
use App\Library\Support\DataSource;

interface MaqeBotIteratorInterface
{
    /**
     * @param DataSource $dataSource
     * @return void
     */
    public function setData(DataSource $dataSource): void;

    /**
     * @return DataSource|MissingDataSourceException
     */
    public function getData(): DataSource|MissingDataSourceException;

    /**
     * @param $key
     * @return void
     */
    public function seek($key): void;
}
