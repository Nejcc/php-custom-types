<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\SmartPointerTypes;

/**
 * Represents a single-threaded interior mutability smart pointer     RefCell
 * --------------------------------------------------------------------------
 * This class provides interior mutability, allowing a value to be
 * mutated even when references to it are immutable, similar to
 * Rust's RefCell.
 */
final class RefCell
{
    private mixed $value;
    private bool $borrowed_mutably = false;
    private int $borrowed_count = 0;

    /**
     * Constructor for RefCell                                          Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the RefCell class with the given
     * value, providing controlled mutability within a single thread.
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * Borrow the value immutably.                                     Immutable Borrow
     * --------------------------------------------------------------------------
     * Allows an immutable reference to the value, provided no mutable
     * reference is currently borrowed. Throws an exception if the
     * value is already borrowed mutably.
     */
    public function borrow(): mixed
    {
        if ($this->borrowed_mutably) {
            throw new \RuntimeException("Value already mutably borrowed.");
        }

        $this->borrowed_count++;
        return $this->value;
    }

    /**
     * Borrow the value mutably.                                       Mutable Borrow
     * --------------------------------------------------------------------------
     * Allows a mutable reference to the value, provided no other
     * reference (mutable or immutable) is currently borrowed. Throws
     * an exception if the value is already borrowed.
     */
    public function borrowMut(): mixed
    {
        if ($this->borrowed_mutably || $this->borrowed_count > 0) {
            throw new \RuntimeException("Value already borrowed.");
        }

        $this->borrowed_mutably = true;
        return $this->value;
    }

    /**
     * Release an immutable borrow.                                    Immutable Release
     * --------------------------------------------------------------------------
     * Decrements the immutable borrow count, allowing new borrows if
     * no other references remain.
     */
    public function release(): void
    {
        if ($this->borrowed_count > 0) {
            $this->borrowed_count--;
        }
    }

    /**
     * Release the mutable borrow.                                     Mutable Release
     * --------------------------------------------------------------------------
     * Releases the mutable borrow, allowing new borrows if no other
     * references remain.
     */
    public function releaseMut(): void
    {
        $this->borrowed_mutably = false;
    }
}
