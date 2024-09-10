<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\SmartPointerTypes;

/**
 * Represents a reference-counted smart pointer                       Rc
 * --------------------------------------------------------------------------
 * This class provides shared ownership of a value through reference
 * counting, similar to Rust's Rc. It tracks the number of references
 * to ensure memory safety.
 */
final class Rc
{
    private mixed $value;
    private int $count;

    /**
     * Constructor for Rc                                               Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the Rc class with the given value.
     * The reference count is set to 1, indicating the initial owner.
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->count = 1;
    }

    /**
     * Clone the Rc instance, incrementing the reference count.         Cloner
     * --------------------------------------------------------------------------
     * Creates a clone of this instance, incrementing the reference
     * count to track the additional reference, ensuring shared
     * ownership is accurately managed.
     */
    public function __clone()
    {
        $this->count++;
    }

    /**
     * Get the current reference count.                                Counter
     * --------------------------------------------------------------------------
     * Returns the current reference count for this value, indicating
     * how many owners exist for the contained value.
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * Get the value stored in Rc.                                     Getter
     * --------------------------------------------------------------------------
     * Returns the value currently managed by this Rc instance,
     * allowing access to the shared data.
     */
    public function get(): mixed
    {
        return $this->value;
    }

    /**
     * Destroy the Rc instance, decrementing the reference count.       Destructor
     * --------------------------------------------------------------------------
     * Decreases the reference count. If it reaches zero, the value is
     * eligible for garbage collection, ensuring proper memory
     * management.
     */
    public function __destruct()
    {
        $this->count--;
    }
}
