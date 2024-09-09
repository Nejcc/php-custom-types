<?php

namespace Nejcc\CustomTypes\Float;

class f32
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = $this->toF32($value);
    }

    private function toF32(float $value): float
    {
        $packed = pack('f', $value); // Pack into 32-bit float
        $unpacked = unpack('f', $packed); // Unpack back into float
        return $unpacked[1];
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}