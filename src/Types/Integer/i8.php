<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\Integer;

use Nejcc\CustomTypes\Types\Nullable\NullableInterface;

final class i8 implements NullableInterface
{
    private int|null $value;

    public function __construct(int|null $value = null)
    {
        $this->setValue($value);
    }

    /**
     * Set the value for this custom integer type.                      Setter
     * --------------------------------------------------------------------------
     * Validates the provided integer value to ensure it falls within 
     * the range allowed for this type. Allows setting a null value.
     */
    public function setValue(int|null $value): void
    {
        if ($value !== null && ($value < -128 || $value > 127)) {
            throw new \InvalidArgumentException("Value must be within the range of a i8 or null.");
        }
        $this->value = $value;
    }

    /**
     * Get the current value of the custom integer type.                Getter
     * --------------------------------------------------------------------------
     * Returns the integer value if set, or null if no value has been 
     * assigned. This is a standard getter method for retrieving data.
     */
    public function getValue(): int|null
    {
        return $this->value;
    }

    /**
     * Checks whether the value is null.                                Nullable
     * --------------------------------------------------------------------------
     * Implements the isNull method required by NullableInterface to 
     * determine if the current value is null, supporting nullable 
     * handling throughout the application.
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }

    public function __toString(): string
    {
        return $this->isNull() ? 'null' : (string)$this->value;
    }
}
