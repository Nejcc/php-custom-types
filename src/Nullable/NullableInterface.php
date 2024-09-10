<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Nullable;

interface NullableInterface
{
    /**
     * Set the value for the nullable type.                             Setter
     * --------------------------------------------------------------------------
     * Sets the value for this type, which can be any mixed type or 
     * null. This method ensures that all implementing classes adhere 
     * to a consistent interface for managing nullable values.
     */
    public function setValue(mixed $value): void;

    /**
     * Get the current value of the nullable type.                      Getter
     * --------------------------------------------------------------------------
     * Returns the value if set, or null if no value has been assigned.
     * This provides a standard method for accessing values across all 
     * implementing types, ensuring interface consistency.
     */
    public function getValue(): mixed;

    /**
     * Check if the current value is null.                              Nullable
     * --------------------------------------------------------------------------
     * Determines whether the current value is null, allowing classes 
     * to handle nullability consistently and provide this information 
     * to the rest of the application or dependent services.
     */
    public function isNull(): bool;
}
?>
