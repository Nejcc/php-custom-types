<?php

namespace Nejcc\CustomTypes\Tests;

use Nejcc\CustomTypes\i32;
use PHPUnit\Framework\TestCase;

class i32Test extends TestCase
{
    public function testValidI32Value()
    {
        $number = new i32(123456);
        $this->assertEquals(123456, $number->getValue());
    }

    public function testInvalidI32ValueTooLow()
    {
        $this->expectException(\InvalidArgumentException::class);
        new i32(-2147483649); // Out of range (too low)
    }

    public function testInvalidI32ValueTooHigh()
    {
        $this->expectException(\InvalidArgumentException::class);
        new i32(2147483648); // Out of range (too high)
    }
}