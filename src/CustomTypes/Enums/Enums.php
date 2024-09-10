<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Enums;

/**
 * Base class for creating custom enumerated types                    Enum
 * --------------------------------------------------------------------------
 * This class provides a base for defining custom enumerations,
 * allowing for a controlled set of named values. It ensures that
 * only valid values defined in the enumeration are used.
 */
abstract class Enum
{
    private string $value;

    /**
     * Constructor for Enum                                            Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the Enum class with the given
     * value. Ensures that the value is valid according to the
     * defined enumeration values.
     */
    public function __construct(string $value)
    {
        if (!in_array($value, static::values(), true)) {
            throw new \InvalidArgumentException("Invalid value '{$value}' for enum " . static::class);
        }

        $this->value = $value;
    }

    /**
     * Get the current enum value.                                     Getter
     * --------------------------------------------------------------------------
     * Returns the current value of the enumeration instance,
     * allowing access to the encapsulated named value.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Convert the enum value to a string representation.              ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the current enumeration
     * value, useful for output, logging, or comparison operations.
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Get all valid values for the enumeration.                       Static Values
     * --------------------------------------------------------------------------
     * Returns an array of all valid values for the enumeration. This
     * method must be overridden by the derived enum classes to
     * provide their specific set of valid values.
     */
    abstract public static function values(): array;
}
