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

# Create necessary directories
echo "Creating directories..."
mkdir -p src/Types/Integer
mkdir -p src/Types/Float
mkdir -p src/Types/Char
mkdir -p src/Types/Bool
mkdir -p src/Types/String
mkdir -p src/Types/Compound
mkdir -p src/Types/Nullable
mkdir -p tests/Integer
mkdir -p tests/Float
mkdir -p tests/Char
mkdir -p tests/Bool
mkdir -p tests/String
mkdir -p tests/Compound

# Create composer.json file
composer_content=$(cat <<EOL
{
  "name": "nejcc/php-custom-types",
  "description": "A Laravel package providing custom data types like i8, u8, i32, u32, f32, etc.",
  "type": "library",
  "license": "MIT",
  "authors": [
    {
      "name": "Nejc",
      "email": "your-email@example.com"
    }
  ],
  "require": {
    "php": ">=8.3"
  },
  "require-dev": {
    "phpunit/phpunit": "^10.0"
  },
  "autoload": {
    "psr-4": {
      "Nejcc\\\\CustomTypes\\\\Types\\\\Integer\\\\": "src/Types/Integer/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Float\\\\": "src/Types/Float/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Char\\\\": "src/Types/Char/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Bool\\\\": "src/Types/Bool/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\String\\\\": "src/Types/String/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Compound\\\\": "src/Types/Compound/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Nullable\\\\": "src/Types/Nullable/"
    }
  },
  "extra": {
    "laravel": {
      "providers": [
        "Nejcc\\\\CustomTypes\\\\CustomTypesServiceProvider"
      ]
    }
  },
  "minimum-stability": "stable",
  "prefer-stable": true
}
EOL
)
create_file "composer.json" "$composer_content"

# Create CustomTypesServiceProvider.php
service_provider_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes;

use Illuminate\Support\ServiceProvider;

final class CustomTypesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.                               Services
     * --------------------------------------------------------------------------
     * This method binds custom type classes to the service container 
     * and makes them available throughout the Laravel application.
     */
    public function register(): void
    {
        // Register custom types or bindings here
    }

    /**
     * Bootstrap any package services.                                  Bootstraps
     * --------------------------------------------------------------------------
     * This method is used to bootstrap any package-specific services, 
     * such as publishing configuration files or performing other 
     * necessary startup tasks for the package.
     */
    public function boot(): void
    {
        // Bootstrapping services for the package
    }
}
?>
EOL
)
create_file "src/CustomTypesServiceProvider.php" "$service_provider_content"

# Create the Integer type classes with interfaces
integer_types=("i8" "u8" "i16" "u16" "i32" "u32" "i64" "u64" "i128" "u128")
for type in "${integer_types[@]}"; do
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
        \$min = ${type/i/}-${type/i/128 ? "128" : "32"};
        \$max = ${type/i/}${type/i/128 ? "128" : "32"} - 1;
        if (\$value !== null && (\$value < \$min || \$value > \$max)) {
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

# Create Nullable Interface
nullable_interface_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\Nullable;

interface NullableInterface
{
    /**
     * Set the value for the nullable type.                             Setter
     * --------------------------------------------------------------------------
     * Sets the value for this type, which can be any mixed type or 
     * null. This method ensures that all implementing classes adhere 
     * to a consistent interface for managing nullable values.
     */
    public function setValue(mixed \$value): void;

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
EOL
)
create_file "src/Types/Nullable/NullableInterface.php" "$nullable_interface_content"

# Create unit tests for Integer types
for type in "${integer_types[@]}"; do
integer_test_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\Integer;

use Nejcc\CustomTypes\Types\Integer\\$type;
use PHPUnit\Framework\TestCase;

final class ${type}Test extends TestCase
{
    /**
     * Test creating a valid $type instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of $type can be created with valid 
     * input and that the stored value matches the provided value.
     */
    public function testCanCreateValid${type}()
    {
        \$value = new $type(100);
        \$this->assertSame(100, \$value->getValue());
    }

    /**
     * Test setting a null value.                                       Setter
     * --------------------------------------------------------------------------
     * Verifies that the setValue method can accept null without 
     * throwing an exception, ensuring proper handling of nullable 
     * types in PHP 8.3 and beyond.
     */
    public function testCanSetNullValue()
    {
        \$value = new $type(null);
        \$this->assertTrue(\$value->isNull());
    }

    /**
     * Test setting an out-of-range value.                              Exception
     * --------------------------------------------------------------------------
     * Ensures that attempting to set a value outside the allowed 
     * range throws an InvalidArgumentException, maintaining type 
     * safety and preventing invalid data entries.
     */
    public function testOutOfRangeThrowsException()
    {
        \$this->expectException(\InvalidArgumentException::class);
        new $type(${type/i/}${type/i/128 ? "129" : "33"});
    }
}
EOL
)
create_file "tests/Integer/${type}Test.php" "$integer_test_content"
done

echo "Setup complete. All files, directories, and tests have been created or updated."
