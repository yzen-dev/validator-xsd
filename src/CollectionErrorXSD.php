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
 * @package ValidatorXSD
 */
class CollectionErrorXSD extends Collection
{
    /**
     * CollectionErrorXSD constructor.
     *
     * @param array<LibXMLError> $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct($this->prepare($errors));
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
}
