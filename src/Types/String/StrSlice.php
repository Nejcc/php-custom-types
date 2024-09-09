<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\String;

/**
 * Represents an immutable string slice (reference)                 StrSlice
 * --------------------------------------------------------------------------
 * This class holds a reference to an existing string, allowing it 
 * to behave like a borrowed string slice. The original string is 
 * not owned or modified by this class, ensuring safe and read-only 
 * access to the underlying data.
 */
final class StrSlice
{
    private string $slice;

    public function __construct(string $source, int $start, ?int $length = null)
    {
        $this->slice = $length !== null ? mb_substr($source, $start, $length) : mb_substr($source, $start);
    }

    /**
     * Get the string slice value.                                     Getter
     * --------------------------------------------------------------------------
     * Returns the immutable string slice held by this class, allowing 
     * read-only access to the referenced portion of the original 
     * string data without modification.
     */
    public function getSlice(): string
    {
        return $this->slice;
    }

    /**
     * Convert the string slice to a string representation.            ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the string slice, allowing 
     * it to be easily output, logged, or used in concatenation with 
     * other strings while maintaining immutability.
     */
    public function __toString(): string
    {
        return $this->slice;
    }
}
