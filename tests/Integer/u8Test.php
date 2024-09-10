<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\Integer;

use PHPUnit\Framework\TestCase;

final class u8Test extends TestCase
{
    /**
     * Test creating a valid u8 instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of u8 can be created with valid 
     * input and that the stored value matches the provided value.
     */
    public function testCanCreateValidu8()
    {
        $value = new \Nejcc\CustomTypes\ScalarTypes\Integers\Unsigned\u8(100);
        $this->assertSame(100, $value->getValue());
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
        $value = new \Nejcc\CustomTypes\ScalarTypes\Integers\Unsigned\u8(null);
        $this->assertTrue($value->isNull());
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
        $this->expectException(\InvalidArgumentException::class);
        new \Nejcc\CustomTypes\ScalarTypes\Integers\Unsigned\u8(u8u8);
    }
}
?>
