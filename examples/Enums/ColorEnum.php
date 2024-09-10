<?php

namespace Nejcc\CustomTypes\Enums;

final class ColorEnum extends Enum
{
    public const RED = 'red';
    public const GREEN = 'green';
    public const BLUE = 'blue';

    /**
     * Get all valid values for the ColorEnum enumeration.             Values
     * --------------------------------------------------------------------------
     * Returns an array of all valid values for the ColorEnum class,
     * defining the specific set of allowed color names.
     */
    public static function values(): array
    {
        return [
            self::RED,
            self::GREEN,
            self::BLUE,
        ];
    }
}
