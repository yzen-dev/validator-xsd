<?php

declare(strict_types=1);

namespace ValidatorXSD;

use Countable;
use IteratorAggregate;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    protected Collection $collection;
    protected array $data = [
        ['element' => 'element 1', 'message' => 'message 1'],
        ['element' => 'element 2', 'message' => 'message 2'],
        ['element' => 'element 3', 'message' => 'message 3'],
        ['element' => 'element 3', 'message' => 'message 3']
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->collection = new Collection($this->data);
    }

    public function testToArray(): void
    {
        $array = $this->collection->toArray();
        self::assertIsArray($array);
        self::assertEquals($this->data, $array);
    }


    public function testCount(): void
    {
        self::assertInstanceOf(Countable::class, $this->collection);
        self::assertCount(count($this->data), $this->collection);
        self::assertEquals(count($this->data), $this->collection->count());
    }

    public function testPluck(): void
    {
        $messages = [];
        foreach ($this->data as $item) {
            $messages[] = $item['message'];
        }
        $pluck = $this->collection->pluck('message')->toArray();
        self::assertEquals($messages, $pluck);
    }

    public function testGetIterator(): void
    {
        self::assertInstanceOf(IteratorAggregate::class, $this->collection);
    }

    public function testGroupBy(): void
    {
        $groupBy = $this->collection->groupBy('element')->toArray();
        self::assertCount(3, $groupBy);
        self::assertCount(2, $groupBy['element 3']);
    }
}
