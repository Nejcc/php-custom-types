<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\CollectionTypes;

/**
 * Represents an unordered collection of unique values              HashSet
 * --------------------------------------------------------------------------
 * This class provides an unordered collection of unique values,
 * similar to Rust's HashSet. It ensures all elements are unique and
 * provides methods for adding, removing, and checking elements.
 */
final class HashSet
{
    private array $elements = [];

    /**
     * Add an element to the HashSet.                                  Adder
     * --------------------------------------------------------------------------
     * Adds a unique element to the collection. If the element
     * already exists, it is not added again, maintaining the unique
     * nature of the HashSet.
     */
    public function add($element): void
    {
        $this->elements[$this->getElementKey($element)] = $element;
    }

    /**
     * Remove an element from the HashSet.                             Remover
     * --------------------------------------------------------------------------
     * Removes the specified element from the collection. If the
     * element does not exist, no action is taken, maintaining the
     * integrity of the HashSet.
     */
    public function remove($element): void
    {
        unset($this->elements[$this->getElementKey($element)]);
    }

    /**
     * Check if an element exists in the HashSet.                      Checker
     * --------------------------------------------------------------------------
     * Determines whether the specified element is in the collection,
     * returning true if it exists and false otherwise.
     */
    public function contains($element): bool
    {
        return isset($this->elements[$this->getElementKey($element)]);
    }

    /**
     * Get the number of elements in the HashSet.                      Counter
     * --------------------------------------------------------------------------
     * Returns the total number of unique elements stored in this
     * collection, providing an easy way to determine its size.
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * Convert the HashSet to a string representation.                 ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the HashSet, listing all
     * elements in order. Useful for output, logging, or debugging
     * purposes.
     */
    public function __toString(): string
    {
        return 'HashSet(' . implode(', ', array_map(function ($element) {
                return is_scalar($element) ? (string) $element : json_encode($element);
            }, $this->elements)) . ')';
    }

    /**
     * Get a unique key for the element for storage in the set.        Key Generator
     * --------------------------------------------------------------------------
     * Generates a unique key for storing an element in the HashSet
     * based on its value, ensuring that each element is distinct.
     */
    private function getElementKey($element): string
    {
        return is_object($element) ? spl_object_hash($element) : (string) $element;
    }
}
