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

# Create the Char type class
char_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Types\Char;

/**
 * Represents a single Unicode character                              Char
 * --------------------------------------------------------------------------
 * This class encapsulates a single character, ensuring that it is a 
 * valid UTF-8 encoded Unicode scalar value. It provides methods to 
 * validate, access, and manipulate a single character efficiently.
 */
final class Char
{
    private string \$char;

    public function __construct(string \$char)
    {
        \$this->setChar(\$char);
    }

    /**
     * Set the value for the character.                                Setter
     * --------------------------------------------------------------------------
     * Validates the provided string to ensure it represents exactly 
     * one valid Unicode character. Throws an exception if the input 
     * is invalid, maintaining data integrity and correctness.
     */
    public function setChar(string \$char): void
    {
        if (mb_strlen(\$char, 'UTF-8') !== 1) {
            throw new \InvalidArgumentException("Value must be a single Unicode character.");
        }
        \$this->char = \$char;
    }

    /**
     * Get the current character value.                                Getter
     * --------------------------------------------------------------------------
     * Returns the character currently stored in this class, allowing 
     * access to the encapsulated single Unicode character. Ensures 
     * correct and safe usage of character data in the application.
     */
    public function getChar(): string
    {
        return \$this->char;
    }

    /**
     * Convert the character to a string representation.               ToString
     * --------------------------------------------------------------------------
     * Provides a string representation of the character, making it 
     * easy to output, log, or concatenate with other strings while 
     * preserving the integrity of the character data.
     */
    public function __toString(): string
    {
        return \$this->char;
    }
}
EOL
)
create_file "src/Types/Char/Char.php" "$char_content"

# Create unit test for Char type
char_test_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\Char;

use Nejcc\CustomTypes\Types\Char\Char;
use PHPUnit\Framework\TestCase;

final class CharTest extends TestCase
{
    /**
     * Test creating a valid Char instance.                            Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of Char can be created with a valid 
     * single character and that the stored value matches the input.
     */
    public function testCanCreateValidChar()
    {
        \$char = new Char("A");
        \$this->assertSame("A", \$char->getChar());
    }

    /**
     * Test setting an invalid character.                              Exception
     * --------------------------------------------------------------------------
     * Verifies that attempting to set a value that is not a single 
     * Unicode character throws an InvalidArgumentException, ensuring 
     * type safety and data integrity.
     */
    public function testSetInvalidCharThrowsException()
    {
        \$this->expectException(\InvalidArgumentException::class);
        new Char("AB");
    }

    /**
     * Test converting Char to string.                                 ToString
     * --------------------------------------------------------------------------
     * Checks that the character is correctly converted to a string, 
     * allowing it to be used in concatenation or output operations 
     * while preserving its value.
     */
    public function testCharToStringConversion()
    {
        \$char = new Char("Z");
        \$this->assertSame("Z", (string)\$char);
    }
}
EOL
)
create_file "tests/Char/CharTest.php" "$char_test_content"
