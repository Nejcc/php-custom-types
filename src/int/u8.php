<?php

namespace Nejcc\CustomTypes;

class u8
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0 || $value > 255) {
            throw new \InvalidArgumentException("Value must be within the range of an 8-bit unsigned integer (0 to 255).");
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