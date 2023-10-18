<?php

namespace App\Library\Support;

use App\Interfaces\DataSourceInterface;

class DataSource implements DataSourceInterface
{
    /**
     * @var array
     */
    private array $items = [];

    /**
     * @param string|int $item
     * @return void
     */
    public function addItem(string|int $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @param int $index
     * @return string|int
     */
    public function getItem(int $index): string|int
    {
        return $this->items[$index];
    }

    /**
     * @param int $index
     * @return bool
     */
    public function isValidIndex(int $index): bool
    {
        return isset($this->items[$index]);
    }
}
