<?php

namespace App\Interfaces;

interface DataSourceInterface
{
    /**
     * @param string|int $item
     * @return void
     */
    public function addItem(string|int $item): void;

    /**
     * @param int $index
     * @return string|int
     */
    public function getItem(int $index): string|int;

    /**
     * @param int $index
     * @return bool
     */
    public function isValidIndex(int $index): bool;
}
