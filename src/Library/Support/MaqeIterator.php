<?php

namespace App\Library\Support;

use App\Interfaces\MaqeBotIteratorInterface;
use Iterator;
use OutOfBoundsException;

class MaqeIterator implements Iterator, MaqeBotIteratorInterface
{
    /**
     * @var DataSource
     */
    private DataSource $data;

    /**
     * @var int
     */
    private int $position;

    /**
     * Set the default position
     */
    public function __construct()
    {
        $this->position = 0;
    }

    /**
     * @param DataSource $dataSource
     * @return void
     */
    public function setData(DataSource $dataSource): void
    {
        $this->data = $dataSource;
    }

    /**
     * @return string|int
     */
    public function current(): string|int
    {
        return $this->data->getItem($this->position);
    }


    /**
     * @return void
     */
    public function next(): void
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->data->isValidIndex($this->position);
    }

    /**
     * Reset the cursor of iterator
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Return the cursor of iterator to a given position.
     *
     * @param $key
     * @return void
     */
    public function seek($key): void
    {
        if ($this->data->isValidIndex($key)) {
            $this->position = $key;
        } else {
            throw new OutOfBoundsException("Invalid seek position");
        }
    }
}