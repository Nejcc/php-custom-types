<?php


use Nejcc\CustomTypes\StringTypes\StrSlice;
use Nejcc\CustomTypes\StringTypes\OwnedString;

$owned = new OwnedString("Hello");
$owned->append(", world!");

$slice = new StrSlice($owned->getValue(), 7, 5);

echo "OwnedString: " . $owned . PHP_EOL;  // Outputs: OwnedString: Hello, world!
echo "StrSlice: " . $slice . PHP_EOL;     // Outputs: StrSlice: world