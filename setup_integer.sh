#!/bin/bash

# Function to create a file and populate it if it doesn't exist, or prompt for overwrite
create_file() {
    local file_path=$1
    local content=$2

    if [ -f "$file_path" ]; then
        read -p "$file_path exists. Do you want to overwrite it? (y/n): " choice
        if [ "$choice" != "y" ]; then
            echo "Skipping $file_path"
            return
        fi
    fi

    echo "Creating $file_path..."
    echo "$content" > "$file_path"
}

# Create the Integer type classes with interfaces
integer_types=("i8" "u8" "i16" "u16" "i32" "u32" "i64" "u64" "i128" "u128")
for type in "${integer_types[@]}"; do
    min_value="0"
    max_value="0"

    # Set min and max values for each integer type
    case "$type" in
        "i8") min_value="-128"; max_value="127";;
        "u8") min_value="0"; max_value="255";;
        "i16") min_value="-32768"; max_value="32767";;
        "u16") min_value="0"; max_value="65535";;
        "i32") min_value="-2147483648"; max_value="2147483647";;
        "u32") min_value="0"; max_value="4294967295";;
        "i64") min_value="-9223372036854775808"; max_value="9223372036854775807";;
        "u64") min_value="0"; max_value="18446744073709551615";;
        "i128") min_value="-170141183460469231731687303715884105728"; max_value="170141183460469231731687303715884105727";;
        "u128") min_value="0"; max_value="340282366920938463463374607431768211455";;
    esac

integer_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\Integer;

use Nejcc\CustomTypes\Types\Nullable\NullableInterface;

final class $type implements NullableInterface
{
    private int|null \$value;

    public function __construct(int|null \$value = null)
    {
        \$this->setValue(\$value);
    }

    /**
     * Set the value for this custom integer type.                      Setter
     * --------------------------------------------------------------------------
     * Validates the provided integer value to ensure it falls within 
     * the range allowed for this type. Allows setting a null value.
     */
    public function setValue(int|null \$value): void
    {
        if (\$value !== null && (\$value < $min_value || \$value > $max_value)) {
            throw new \InvalidArgumentException("Value must be within the range of a $type or null.");
        }
        \$this->value = \$value;
    }

    /**
     * Get the current value of the custom integer type.                Getter
     * --------------------------------------------------------------------------
     * Returns the integer value if set, or null if no value has been 
     * assigned. This is a standard getter method for retrieving data.
     */
    public function getValue(): int|null
    {
        return \$this->value;
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
        return \$this->value === null;
    }

    public function __toString(): string
    {
        return \$this->isNull() ? 'null' : (string)\$this->value;
    }
}
EOL
)
    create_file "src/Types/Integer/${type}.php" "$integer_content"
done
