<?php

namespace Nejcc\CustomTypes;

class i32
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < -2147483648 || $value > 2147483647) {
            throw new \InvalidArgumentException("Value must be within the range of a 32-bit signed integer (-2147483648 to 2147483647).");
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