<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\CollectionTypes;

/**
 * Represents a key-value store                                     HashMap
 * --------------------------------------------------------------------------
 * This class provides a key-value store, similar to Rust's HashMap.
 * It allows storing and managing key-value pairs, with methods for
 * adding, removing, and accessing values by their keys.
 */
final class HashMap
{
    private array $elements = [];

    /**
     * Add a key-value pair to the HashMap.                            Adder
     * --------------------------------------------------------------------------
     * Adds a key-value pair to the map. If the key already exists,
     * its value is updated to the new value.
     */
    public function put($key, $value): void
    {
        $this->elements[$this->getKeyHash($key)] = $value;
    }

    /**
     * Get a value by its key.                                         Getter
     * --------------------------------------------------------------------------
     * Retrieves a value from the map based on its key. Throws an
     * exception if the key does not exist, ensuring safe access to
     * values.
     */
    public function get($key)
    {
        $hash = $this->getKeyHash($key);
        if (!array_key_exists($hash, $this->elements)) {
            throw new \OutOfBoundsException("Key does not exist in the HashMap.");
        }
        return $this->elements[$hash];
    }

    /**
     * Remove a key-value pair from the HashMap.                       Remover
     * --------------------------------------------------------------------------
     * Removes a key-value pair from the map based on its key. If the
     * key does not exist, no action is taken, maintaining the
     * integrity of the HashMap.
     */
    public function remove($key): void
    {
        unset($this->elements[$this->getKeyHash($key)]);
    }

    /**
     * Check if a key exists in the HashMap.                           Checker
     * --------------------------------------------------------------------------
     * Determines whether the specified key exists in the map,
     * returning true if it does and false otherwise.
     */
    public function containsKey($key): bool
    {
        return isset($this->elements[$this->getKeyHash($key)]);
    }

    /**
     * Get the number of elements in the HashMap.                      Counter
     * --------------------------------------------------------------------------
     * Returns the total number of key-value pairs stored in this
     * map, providing an easy way to determine its size.
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * Convert the HashMap to a string representation.                 ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the HashMap, listing all
     * key-value pairs. Useful for output, logging, or debugging
     * purposes.
     */
    public function __toString(): string
    {
        return 'HashMap(' . implode(', ', array_map(
                fn($key, $value) => "$key: " . (is_scalar($value) ? $value : json_encode($value)),
                array_keys($this->elements),
                $this->elements
            )) . ')';
    }

    /**
     * Generate a unique key hash for storage in the map.              Key Hash Generator
     * --------------------------------------------------------------------------
     * Generates a unique hash for a given key, ensuring that keys
     * can be efficiently stored and retrieved.
     */
    private function getKeyHash($key): string
    {
        return is_object($key) ? spl_object_hash($key) : (string) $key;
    }
}
