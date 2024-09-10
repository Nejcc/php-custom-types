<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\ScalarTypes\FloatPoints;

use Nejcc\CustomTypes\Nullable\NullableInterface;

final class f32 implements NullableInterface
{
    private float|null $value;

    public function __construct(float|null $value = null)
    {
        $this->setValue($value);
    }

    /**
     * Set the value for this custom float type.                        Setter
     * --------------------------------------------------------------------------
     * Assigns a floating-point number to this type after validation 
     * of its format. Allows the value to be set to null to support 
     * flexible handling of optional data values in applications.
     */
    public function setValue(float|null $value): void
    {
        $this->value = $value;
    }

    /**
     * Get the current value of the custom float type.                  Getter
     * --------------------------------------------------------------------------
     * Returns the floating-point value if set, or null if the value 
     * has not been initialized. Provides access to the stored value 
     * while maintaining strict type safety and data encapsulation.
     */
    public function getValue(): float|null
    {
        return $this->value;
    }

    /**
     * Checks whether the value is null.                                Nullable
     * --------------------------------------------------------------------------
     * Implements the isNull method from NullableInterface to verify 
     * if the current value is null, allowing easy handling of nullable 
     * data types across various operations in your application.
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
