<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\ScalarTypes\Boolean;

/**
 * Represents a custom Boolean type                                   Bool
 * --------------------------------------------------------------------------
 * This class encapsulates a boolean value, providing a clear and
 * strict type definition for Boolean operations. It ensures that
 * only valid Boolean values (`true` or `false`) are used.
 */
final class Boolean
{
    private bool $value;

    /**
     * Constructor for Bool                                            Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the Bool class with the given
     * Boolean value, ensuring strict typing and valid input for the
     * custom Boolean type.
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * Get the current Boolean value.                                  Getter
     * --------------------------------------------------------------------------
     * Returns the current Boolean value stored in this instance,
     * allowing access to the encapsulated `true` or `false` state.
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * Negate the current Boolean value.                               Negator
     * --------------------------------------------------------------------------
     * Toggles the current Boolean value from `true` to `false` or
     * vice versa, providing a basic Boolean operation for use in
     * logical expressions or conditions.
     */
    public function negate(): void
    {
        $this->value = !$this->value;
    }

    /**
     * Convert the Boolean value to a string representation.           ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the Boolean value (`true`
     * or `false`), useful for output, logging, or concatenation with
     * other strings.
     */
    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }
}
