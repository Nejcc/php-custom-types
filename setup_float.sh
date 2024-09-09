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

# Create the Float type classes with interfaces
float_types=("f16" "f32" "f64" "f128")
for type in "${float_types[@]}"; do

float_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\Float;

use Nejcc\CustomTypes\Types\Nullable\NullableInterface;

final class $type implements NullableInterface
{
    private float|null \$value;

    public function __construct(float|null \$value = null)
    {
        \$this->setValue(\$value);
    }

    /**
     * Set the value for this custom float type.                        Setter
     * --------------------------------------------------------------------------
     * Assigns a floating-point number to this type after validation 
     * of its format. Allows the value to be set to null to support 
     * flexible handling of optional data values in applications.
     */
    public function setValue(float|null \$value): void
    {
        \$this->value = \$value;
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
        return \$this->value;
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
        return \$this->value === null;
    }

    public function __toString(): string
    {
        return \$this->isNull() ? 'null' : (string)\$this->value;
    }
}
EOL
)
    create_file "src/Types/Float/${type}.php" "$float_content"
done

# Create unit tests for Float types
for type in "${float_types[@]}"; do
float_test_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\Float;

use Nejcc\CustomTypes\Types\Float\\$type;
use PHPUnit\Framework\TestCase;

final class ${type}Test extends TestCase
{
    /**
     * Test creating a valid $type instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of $type can be created with valid 
     * input and that the stored value matches the provided float.
     */
    public function testCanCreateValid${type}()
    {
        \$value = new $type(3.14);
        \$this->assertSame(3.14, \$value->getValue());
    }

    /**
     * Test setting a null value.                                       Setter
     * --------------------------------------------------------------------------
     * Verifies that the setValue method can accept null without 
     * throwing an exception, ensuring proper handling of nullable 
     * float types in PHP 8.3 and beyond.
     */
    public function testCanSetNullValue()
    {
        \$value = new $type(null);
        \$this->assertTrue(\$value->isNull());
    }

    /**
     * Test converting to string.                                       ToString
     * --------------------------------------------------------------------------
     * Checks the string conversion to ensure that a valid float is 
     * properly converted to its string representation or to 'null' 
     * if the value is not set, maintaining consistency in output.
     */
    public function testToStringConversion()
    {
        \$value = new $type(2.71);
        \$this->assertSame('2.71', (string)\$value);

        \$value = new $type(null);
        \$this->assertSame('null', (string)\$value);
    }
}
EOL
)
    create_file "tests/Float/${type}Test.php" "$float_test_content"
done
