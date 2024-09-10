<?php

use Nejcc\CustomTypes\ScalarTypes\Boolean\Boolean;

$boolValue = new Boolean(true);

echo "Initial value: " . $boolValue . PHP_EOL; // Outputs: Initial value: true

$boolValue->negate();
echo "Negated value: " . $boolValue . PHP_EOL; // Outputs: Negated value: false
