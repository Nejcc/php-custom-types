<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\Char;

/**
 * Represents a single Unicode character                              Char
 * --------------------------------------------------------------------------
 * This class encapsulates a single character, ensuring that it is a 
 * valid UTF-8 encoded Unicode scalar value. It provides methods to 
 * validate, access, and manipulate a single character efficiently.
 */
final class Char
{
    private string $char;

    public function __construct(string $char)
    {
        $this->setChar($char);
    }

    /**
     * Set the value for the character.                                Setter
     * --------------------------------------------------------------------------
     * Validates the provided string to ensure it represents exactly 
     * one valid Unicode character. Throws an exception if the input 
     * is invalid, maintaining data integrity and correctness.
     */
    public function setChar(string $char): void
    {
        if (mb_strlen($char, 'UTF-8') !== 1) {
            throw new \InvalidArgumentException("Value must be a single Unicode character.");
        }
        $this->char = $char;
    }

    /**
     * Get the current character value.                                Getter
     * --------------------------------------------------------------------------
     * Returns the character currently stored in this class, allowing 
     * access to the encapsulated single Unicode character. Ensures 
     * correct and safe usage of character data in the application.
     */
    public function getChar(): string
    {
        return $this->char;
    }

    /**
     * Convert the character to a string representation.               ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the character, making it 
     * easy to output, log, or concatenate with other strings while 
     * preserving the integrity of the character data.
     */
    public function __toString(): string
    {
        return $this->char;
    }
}
