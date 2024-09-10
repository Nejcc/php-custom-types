<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Struct;

/**
 * Base class for creating custom data structures                    Struct
 * --------------------------------------------------------------------------
 * This class provides a base for defining custom data structures
 * with named fields. It ensures that fields are defined dynamically
 * and that the structure can be easily extended for various use cases.
 */
abstract class Struct
{
    private array $fields = [];

    /**
     * Constructor for Struct                                          Constructor
     * --------------------------------------------------------------------------
     * Initializes a new instance of the Struct class with the given
     * fields. Ensures that only defined fields are initialized and
     * allows for strict typing of each field in derived structures.
     */
    public function __construct(array $fields)
    {
        foreach ($fields as $name => $value) {
            if (!property_exists($this, $name)) {
                throw new \InvalidArgumentException("Field '{$name}' is not defined in struct " . static::class);
            }
            $this->$name = $value;
        }
    }

    /**
     * Get a field value by name.                                      Getter
     * --------------------------------------------------------------------------
     * Returns the value of a specified field in the struct, allowing
     * access to the encapsulated data while ensuring that only valid
     * fields are accessed.
     */
    public function getField(string $name)
    {
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException("Field '{$name}' is not defined in struct " . static::class);
        }
        return $this->$name;
    }

    /**
     * Set a field value by name.                                      Setter
     * --------------------------------------------------------------------------
     * Sets the value of a specified field in the struct, ensuring
     * that only valid fields are modified and maintaining strict
     * typing and data integrity.
     */
    public function setField(string $name, $value): void
    {
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException("Field '{$name}' is not defined in struct " . static::class);
        }
        $this->$name = $value;
    }

    /**
     * Convert the struct to a string representation.                  ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the struct, listing all
     * field names and their corresponding values, useful for output,
     * logging, or debugging purposes.
     */
    public function __toString(): string
    {
        $fields = get_object_vars($this);
        return static::class . ' {' . implode(', ', array_map(
                fn($key, $value) => "$key: " . (is_scalar($value) ? $value : json_encode($value)),
                array_keys($fields),
                $fields
            )) . '}';
    }
}