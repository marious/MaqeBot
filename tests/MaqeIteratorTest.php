<?php

use App\Library\Support\DataSource;
use App\Library\Support\MaqeIterator;
use PHPUnit\Framework\TestCase;

class MaqeIteratorTest extends TestCase
{
    public function testSeekMethod(): void
    {
        // Create a DataSource with expected data
        $expectedData = ['R', 'W', '5', 'L', 'W', '2'];

        $dataSource = new DataSource();
        foreach ($expectedData as $item) {
            $dataSource->addItem($item);
        }

        $iterator = new MaqeIterator();
        $iterator->setData($dataSource);

        // Seek to a specific position in the MaqeIterator
        $seekPosition = 1;
        $iterator->seek($seekPosition);

        // Check if the current position matches the expected position
        $this->assertEquals($seekPosition, $iterator->key());

        // Check if the current element matches the expected element
        $this->assertEquals($expectedData[$seekPosition], $iterator->current());
    }

    public function testSeekMethodOutOfBounds(): void
    {
        // Create a DataSource with expected data
        $expectedData = ['R', 'W', '5', 'L', 'W', '3'];
        $dataSource = new DataSource();
        foreach ($expectedData as $item) {
            $dataSource->addItem($item);
        }

        $iterator = new MaqeIterator();
        $iterator->setData($dataSource);

        // Attempt to seek to an out-of-bounds position
        $seekPosition = 10;

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Invalid seek position");

        $iterator->seek($seekPosition);
    }

}