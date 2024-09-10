<?php

use Nejcc\CustomTypes\Enums\ColorEnum;

try {
    $color = new ColorEnum(ColorEnum::RED);
    echo "Selected color: " . $color . PHP_EOL; // Outputs: Selected color: red

    $invalidColor = new ColorEnum('yellow'); // Throws InvalidArgumentException
} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
