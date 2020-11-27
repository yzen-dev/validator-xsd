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
 * @implements IteratorAggregate<ErrorXSD>
 * @package ValidatorXSD
 */
class CollectionErrorXSD implements Countable, IteratorAggregate
{
    /** @var array<int, ErrorXSD> */
    private array $items;
    
    /**
     * CollectionErrorXSD constructor.
     *
     * @param array<LibXMLError> $errors
     */
    public function __construct(array $errors)
    {
        $this->items = $this->prepare($errors);
    }
    
    /**
     * Casting LibXMLError errors to ErrorXSD
     *
     * @param array<LibXMLError> $items
     *
     * @return array<ErrorXSD>
     */
    public function prepare(array $items): array
    {
        $collection = [];
        foreach ($items as $error) {
            $collection [] = ParseLibXMLError::parse($error);
        }
        return $collection;
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
}
