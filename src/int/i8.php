<?php

namespace Nejcc\CustomTypes\Int;

class i8
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < -128 || $value > 127) {
            throw new \InvalidArgumentException("Value must be within the range of an 8-bit signed integer (-128 to 127).");
        }
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}