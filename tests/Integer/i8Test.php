<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\Integer;

use Nejcc\CustomTypes\ScalarTypes\Integers\Signed\i8;
use PHPUnit\Framework\TestCase;

final class i8Test extends TestCase
{
    /**
     * Test creating a valid i8 instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of i8 can be created with valid 
     * input and that the stored value matches the provided value.
     */
    public function testCanCreateValidi8()
    {
        $value = new i8(100);
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
        $value = new i8(null);
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
        new i8(8128 ? "129" : "33"8);
    }
}
?>
