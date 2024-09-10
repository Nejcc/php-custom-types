<?php

declare(strict_types=1);

namespace Nejcc\CompoundTypes\FixedArray;

/**
 * Represents a fixed-size collection of homogeneous values           FixedArray
 * --------------------------------------------------------------------------
 * This class allows the creation of a fixed-size array, a collection
 * of values of the same type. It provides methods for accessing,
 * modifying, and managing elements, ensuring that the array size
 * remains constant.
 */
final class FixedArray
{
    private array $elements;
    private int $size;

    /**
     * Constructor for FixedArray                                       Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the FixedArray class with the
     * specified size. Prepares an array of the defined size and
     * ensures all elements are initialized to null.
     */
    public function __construct(int $size)
    {
        if ($size <= 0) {
            throw new \InvalidArgumentException("Size of FixedArray must be a positive integer.");
        }

        $this->size = $size;
        $this->elements = array_fill(0, $size, null);
    }

    /**
     * Get an element by its index.                                    Getter
     * --------------------------------------------------------------------------
     * Retrieves an element from the fixed array at the specified
     * index. Throws an exception if the index is out of bounds,
     * ensuring safe access to array elements.
     */
    public function get(int $index)
    {
        $this->validateIndex($index);
        return $this->elements[$index];
    }

    /**
     * Set an element by its index.                                    Setter
     * --------------------------------------------------------------------------
     * Sets the value of an element in the fixed array at the
     * specified index. Throws an exception if the index is out of
     * bounds, ensuring safe modification of array elements.
     */
    public function set(int $index, $value): void
    {
        $this->validateIndex($index);
        $this->elements[$index] = $value;
    }

    /**
     * Get the number of elements in the fixed array.                  Count
     * --------------------------------------------------------------------------
     * Returns the total number of elements in this fixed array,
     * providing a simple way to determine its size.
     */
    public function count(): int
    {
        return $this->size;
    }

    /**
     * Validate the index for array access.                            Index Validator
     * --------------------------------------------------------------------------
     * Ensures that the specified index is within the valid range of
     * the fixed array. Throws an exception if the index is invalid.
     */
    private function validateIndex(int $index): void
    {
        if ($index < 0 || $index >= $this->size) {
            throw new \OutOfBoundsException("Index {$index} is out of bounds for this FixedArray.");
        }
    }

    /**
     * Convert the fixed array to a string representation.             ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the fixed array, listing
     * all elements in order. Useful for output, logging, or debugging
     * purposes.
     */
    public function __toString(): string
    {
        return 'FixedArray(' . implode(', ', array_map(function ($element) {
                return is_scalar($element) ? (string) $element : json_encode($element);
            }, $this->elements)) . ')';
    }
}
