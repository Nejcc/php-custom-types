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

# Create the String type classes with interfaces
string_types=("StrSlice" "OwnedString")
for type in "${string_types[@]}"; do

if [[ "$type" == "StrSlice" ]]; then
string_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\String;

/**
 * Represents an immutable string slice (reference)                 StrSlice
 * --------------------------------------------------------------------------
 * This class holds a reference to an existing string, allowing it 
 * to behave like a borrowed string slice. The original string is 
 * not owned or modified by this class, ensuring safe and read-only 
 * access to the underlying data.
 */
final class StrSlice
{
    private string \$slice;

    public function __construct(string \$source, int \$start, ?int \$length = null)
    {
        \$this->slice = \$length !== null ? mb_substr(\$source, \$start, \$length) : mb_substr(\$source, \$start);
    }

    /**
     * Get the string slice value.                                     Getter
     * --------------------------------------------------------------------------
     * Returns the immutable string slice held by this class, allowing 
     * read-only access to the referenced portion of the original 
     * string data without modification.
     */
    public function getSlice(): string
    {
        return \$this->slice;
    }

    /**
     * Convert the string slice to a string representation.            ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the string slice, allowing 
     * it to be easily output, logged, or used in concatenation with 
     * other strings while maintaining immutability.
     */
    public function __toString(): string
    {
        return \$this->slice;
    }
}
EOL
)
    create_file "src/Types/String/StrSlice.php" "$string_content"

else
string_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\String;

/**
 * Represents an owned mutable string                                OwnedString
 * --------------------------------------------------------------------------
 * This class owns its string content, providing methods for safely 
 * modifying the string data. It allows for dynamic changes, such as 
 * appending, removing, or clearing content, while managing its memory.
 */
final class OwnedString
{
    private string \$value;

    public function __construct(string \$value = "")
    {
        \$this->value = \$value;
    }

    /**
     * Get the owned string value.                                     Getter
     * --------------------------------------------------------------------------
     * Returns the owned string value managed by this class, allowing 
     * safe access and manipulation of the string content through 
     * provided methods.
     */
    public function getValue(): string
    {
        return \$this->value;
    }

    /**
     * Append a string to the owned string value.                      Appender
     * --------------------------------------------------------------------------
     * Appends the provided string to the existing string value, 
     * allowing for dynamic modification and growth of the string data 
     * managed by this class.
     */
    public function append(string \$suffix): void
    {
        \$this->value .= \$suffix;
    }

    /**
     * Clear the owned string value.                                   Clearer
     * --------------------------------------------------------------------------
     * Clears the current string value, resetting it to an empty 
     * state. This is useful for reusing the OwnedString instance 
     * without retaining previous data.
     */
    public function clear(): void
    {
        \$this->value = "";
    }

    public function __toString(): string
    {
        return \$this->value;
    }
}
EOL
)
    create_file "src/Types/String/OwnedString.php" "$string_content"
fi
done

# Create unit tests for String types
for type in "${string_types[@]}"; do
string_test_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\String;

use Nejcc\CustomTypes\Types\String\\$type;
use PHPUnit\Framework\TestCase;

final class ${type}Test extends TestCase
{
    /**
     * Test creating a valid $type instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of $type can be created with valid 
     * input and that the stored value matches the provided input.
     */
    public function testCanCreateValid${type}()
    {
        if ("$type" === "StrSlice") {
            \$source = "Hello, world!";
            \$slice = new StrSlice(\$source, 7, 5);
            \$this->assertSame("world", \$slice->getSlice());
        } else {
            \$string = new OwnedString("Hello");
            \$this->assertSame("Hello", \$string->getValue());
        }
    }

    /**
     * Test appending a string in OwnedString.                         Appender
     * --------------------------------------------------------------------------
     * Verifies that a string can be appended to an OwnedString 
     * instance and that the resulting value is correct, ensuring 
     * that string data can be dynamically modified.
     */
    public function testAppendOwnedString()
    {
        \$string = new OwnedString("Hello");
        \$string->append(", world!");
        \$this->assertSame("Hello, world!", \$string->getValue());
    }

    /**
     * Test clearing the owned string value.                           Clearer
     * --------------------------------------------------------------------------
     * Ensures that the clear method resets the OwnedString instance 
     * to an empty state, verifying that it can be reused without 
     * retaining any previous data.
     */
    public function testClearOwnedString()
    {
        \$string = new OwnedString("Hello");
        \$string->clear();
        \$this->assertSame("", \$string->getValue());
    }

    /**
     * Test converting StrSlice to string.                             ToString
     * --------------------------------------------------------------------------
     * Checks the string conversion to ensure that a valid string 
     * slice is properly converted to its string representation, 
     * maintaining consistency and immutability.
     */
    public function testStrSliceToStringConversion()
    {
        \$source = "Hello, world!";
        \$slice = new StrSlice(\$source, 7, 5);
        \$this->assertSame("world", (string)\$slice);
    }
}
EOL
)
    create_file "tests/String/${type}Test.php" "$string_test_content"
done
