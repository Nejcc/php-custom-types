<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\Float;

use Nejcc\CustomTypes\Types\Float\f64;
use PHPUnit\Framework\TestCase;

final class f64Test extends TestCase
{
    /**
     * Test creating a valid f64 instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of f64 can be created with valid 
     * input and that the stored value matches the provided float.
     */
    public function testCanCreateValidf64()
    {
        $value = new f64(3.14);
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
        $value = new f64(null);
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
        $value = new f64(2.71);
        $this->assertSame('2.71', (string)$value);

        $value = new f64(null);
        $this->assertSame('null', (string)$value);
    }
}
