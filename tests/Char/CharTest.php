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
        $char = new Char("A");
        $this->assertSame("A", $char->getChar());
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
        $this->expectException(\InvalidArgumentException::class);
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
        $char = new Char("Z");
        $this->assertSame("Z", (string)$char);
    }
}
