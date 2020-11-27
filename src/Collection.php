<?php

declare(strict_types=1);

namespace ValidatorXSD;

use Countable;
use LibXMLError;
use ArrayIterator;
use IteratorAggregate;

/**
 * Class CollectionErrorXSD
 *
 * @implements IteratorAggregate<mixed>
 * @package ValidatorXSD
 */
class Collection implements Countable, IteratorAggregate
{
    /** @var array<int, mixed> */
    protected array $items;

    /**
     * CollectionErrorXSD constructor.
     *
     * @param array<mixed> $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Get an iterator for the items.
     *
     * @return ArrayIterator<int, ErrorXSD>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Get the values of a given key.
     * @param array<string> $keys
     * @return Collection
     */
    public function pluck(array $keys): Collection
    {
        $res = [];
        foreach ($this->items as $item) {
            $res [] = array_intersect_key($item->toArray(), array_flip($keys));
        }
        return new self($res);
    }


    /**
     * Group an associative array by a field
     * @param string $key
     * @return Collection
     */
    public function groupBy(string $key): Collection
    {
        $res = array();
        foreach ($this->items as $val) {
            $res[$val[$key]][] = $val;
        }
        return new self($res);
    }
}
