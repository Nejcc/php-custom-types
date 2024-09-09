<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\String;

/**
 * Represents an owned mutable string                                OwnedString
 * --------------------------------------------------------------------------
 * This class owns its string content, providing methods for safely 
 * modifying the string data. It allows for dynamic changes, such as 
 * appending, removing, or clearing content, while managing its memory.
 */
final class OwnedString
{
    private string $value;

    public function __construct(string $value = "")
    {
        $this->value = $value;
    }

    /**
     * Get the owned string value.                                     Getter
     * --------------------------------------------------------------------------
     * Returns the owned string value managed by this class, allowing 
     * safe access and manipulation of the string content through 
     * provided methods.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Append a string to the owned string value.                      Appender
     * --------------------------------------------------------------------------
     * Appends the provided string to the existing string value, 
     * allowing for dynamic modification and growth of the string data 
     * managed by this class.
     */
    public function append(string $suffix): void
    {
        $this->value .= $suffix;
    }

    /**
     * Clear the owned string value.                                   Clearer
     * --------------------------------------------------------------------------
     * Clears the current string value, resetting it to an empty 
     * state. This is useful for reusing the OwnedString instance 
     * without retaining previous data.
     */
    public function clear(): void
    {
        $this->value = "";
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
