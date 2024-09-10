<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes\Tests\String;

use Nejcc\CustomTypes\StringTypes\OwnedString;
use PHPUnit\Framework\TestCase;

final class OwnedStringTest extends TestCase
{
    /**
     * Test creating a valid OwnedString instance.                           Constructor
     * --------------------------------------------------------------------------
     * Ensures that an instance of OwnedString can be created with valid 
     * input and that the stored value matches the provided input.
     */
    public function testCanCreateValidOwnedString()
    {
        if ("OwnedString" === "StrSlice") {
            $source = "Hello, world!";
            $slice = new StrSlice($source, 7, 5);
            $this->assertSame("world", $slice->getSlice());
        } else {
            $string = new OwnedString("Hello");
            $this->assertSame("Hello", $string->getValue());
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
        $string = new OwnedString("Hello");
        $string->append(", world!");
        $this->assertSame("Hello, world!", $string->getValue());
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
        $string = new \Nejcc\CustomTypes\StringTypes\OwnedString("Hello");
        $string->clear();
        $this->assertSame("", $string->getValue());
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
        $source = "Hello, world!";
        $slice = new StrSlice($source, 7, 5);
        $this->assertSame("world", (string)$slice);
    }
}
