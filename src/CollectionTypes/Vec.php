<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\CollectionTypes;

/**
 * Represents a dynamic, growable array                              Vec
 * --------------------------------------------------------------------------
 * This class provides a dynamic, growable array, similar to Rust's
 * Vec. It allows adding, removing, and accessing elements, ensuring
 * efficient handling of dynamically-sized collections in PHP.
 */
final class Vec
{
    private array $elements = [];

    /**
     * Add an element to the Vec.                                      Adder
     * --------------------------------------------------------------------------
     * Appends an element to the end of the dynamic array, allowing
     * for flexible and dynamic growth of the collection.
     */
    public function add($element): void
    {
        $this->elements[] = $element;
    }

    /**
     * Remove an element by index.                                     Remover
     * --------------------------------------------------------------------------
     * Removes the element at the specified index from the dynamic
     * array. Throws an exception if the index is out of bounds.
     */
    public function remove(int $index): void
    {
        if (!array_key_exists($index, $this->elements)) {
            throw new \OutOfBoundsException("Index {$index} is out of bounds for this Vec.");
        }

        array_splice($this->elements, $index, 1);
    }

    /**
     * Get an element by its index.                                    Getter
     * --------------------------------------------------------------------------
     * Retrieves an element from the dynamic array at the specified
     * index. Throws an exception if the index is out of bounds.
     */
    public function get(int $index)
    {
        if (!array_key_exists($index, $this->elements)) {
            throw new \OutOfBoundsException("Index {$index} is out of bounds for this Vec.");
        }

        return $this->elements[$index];
    }

    /**
     * Get the number of elements in the Vec.                          Counter
     * --------------------------------------------------------------------------
     * Returns the total number of elements stored in this dynamic
     * array, providing an easy way to determine its size.
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * Convert the Vec to a string representation.                     ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the dynamic array, listing
     * all elements in order. Useful for output, logging, or debugging
     * purposes.
     */
    public function __toString(): string
    {
        return 'Vec(' . implode(', ', array_map(function ($element) {
                return is_scalar($element) ? (string) $element : json_encode($element);
            }, $this->elements)) . ')';
    }
}
