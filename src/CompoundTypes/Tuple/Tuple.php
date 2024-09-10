<?php

declare(strict_types=1);

namespace Nejcc\CompoundTypes\Tuple;

/**
 * Represents a fixed-size collection of heterogeneous values         Tuple
 * --------------------------------------------------------------------------
 * This class allows the creation of a tuple, a fixed-size collection
 * of values of potentially different types. It provides methods for
 * accessing elements by index and converting the tuple to a string.
 */
final class Tuple
{
    private array $elements;

    /**
     * Constructor for Tuple                                           Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the Tuple class with the given
     * elements. Stores the elements in a fixed-size array, allowing
     * for a combination of different data types.
     */
    public function __construct(...$elements)
    {
        $this->elements = $elements;
    }

    /**
     * Get an element by its index.                                    Getter
     * --------------------------------------------------------------------------
     * Retrieves an element from the tuple at the specified index.
     * Throws an exception if the index is out of bounds, ensuring
     * safe and predictable access to tuple elements.
     */
    public function get(int $index)
    {
        if (!array_key_exists($index, $this->elements)) {
            throw new \OutOfBoundsException("Index {$index} is out of bounds for this tuple.");
        }
        return $this->elements[$index];
    }

    /**
     * Get the number of elements in the tuple.                        Count
     * --------------------------------------------------------------------------
     * Returns the total number of elements stored in this tuple,
     * providing a simple way to determine its size or length.
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * Convert the tuple to a string representation.                   ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the tuple, listing all
     * elements in order. Useful for output, logging, or debugging
     * purposes.
     */
    public function __toString(): string
    {
        return 'Tuple(' . implode(', ', array_map(function ($element) {
                return is_scalar($element) ? (string) $element : json_encode($element);
            }, $this->elements)) . ')';
    }
}
