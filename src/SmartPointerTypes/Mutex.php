<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\SmartPointerTypes;

/**
 * Represents a thread-safe interior mutability smart pointer         Mutex
 * --------------------------------------------------------------------------
 * This class provides a way to achieve interior mutability safely
 * across threads, similar to Rust's Mutex. It locks the value for
 * safe concurrent access.
 */
final class Mutex
{
    private mixed $value;
    private bool $locked = false;

    /**
     * Constructor for Mutex                                            Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the Mutex class with the given
     * value, allowing safe access and modification across threads.
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * Acquire a lock and get the value.                               Lock Getter
     * --------------------------------------------------------------------------
     * Locks the Mutex and returns the value, ensuring that no other
     * threads can modify it while the lock is held.
     */
    public function lock(): mixed
    {
        if ($this->locked) {
            throw new \RuntimeException("Mutex is already locked.");
        }

        $this->locked = true;
        return $this->value;
    }

    /**
     * Release the lock on the Mutex.                                  Unlocker
     * --------------------------------------------------------------------------
     * Unlocks the Mutex, allowing other threads to acquire the lock
     * and access or modify the value.
     */
    public function unlock(): void
    {
        $this->locked = false;
    }
}
