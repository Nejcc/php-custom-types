<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\SmartPointerTypes;

/**
 * Represents a heap-allocated single ownership pointer               Box
 * --------------------------------------------------------------------------
 * This class provides a way to allocate an object on the heap with
 * single ownership, similar to Rust's Box. It ensures that only one
 * owner exists, which can then transfer ownership if needed.
 */
final class Box
{
    private mixed $value;

    /**
     * Constructor for Box                                              Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the Box class with the given
     * value, storing it on the heap and providing exclusive access
     * to the owning scope.
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * Get the value inside the Box.                                   Getter
     * --------------------------------------------------------------------------
     * Returns the value stored in the Box, providing read-only access
     * to the contained object or primitive data type.
     */
    public function get(): mixed
    {
        return $this->value;
    }

    /**
     * Set a new value inside the Box.                                 Setter
     * --------------------------------------------------------------------------
     * Replaces the value stored in the Box with a new value, allowing
     * for dynamic modification of the contained object or data.
     */
    public function set(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * Convert the Box value to a string representation.               ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the Box's value, useful for
     * output, logging, or debugging purposes.
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
