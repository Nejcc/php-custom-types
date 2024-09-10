<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\Float;

use Nejcc\CustomTypes\ScalarTypes\FloatPoints\f32;
use PHPUnit\Framework\TestCase;

final class f32Test extends TestCase
{
    /**
     * Test creating a valid f32 instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of f32 can be created with valid 
     * input and that the stored value matches the provided float.
     */
    public function testCanCreateValidf32()
    {
        $value = new f32(3.14);
        $this->assertSame(3.14, $value->getValue());
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
        $value = new f32(null);
        $this->assertTrue($value->isNull());
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
        $value = new f32(2.71);
        $this->assertSame('2.71', (string)$value);

        $value = new f32(null);
        $this->assertSame('null', (string)$value);
    }
}
