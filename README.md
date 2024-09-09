# PHP Custom Types

[![Latest Stable Version](https://img.shields.io/packagist/v/nejcc/php-custom-types.svg)](https://packagist.org/packages/nejcc/php-custom-types)
[![Total Downloads](https://img.shields.io/packagist/dt/nejcc/php-custom-types.svg)](https://packagist.org/packages/nejcc/php-custom-types)
[![License](https://img.shields.io/packagist/l/nejcc/php-custom-types.svg)](https://packagist.org/packages/nejcc/php-custom-types)

**Nejcc/php-custom-types** is a Laravel package that provides custom data types like `i8`, `u8`, `i32`, `u32`, `f32`, and more. These custom types help enforce data integrity, memory efficiency, and validation constraints in your Laravel applications.

## Features

- **Custom Integer Types**: `i8`, `u8`, `i32`, `u32`
- **Custom Floating Point Type**: `f32`
- **Custom String Type**: `Utf8String`
- **Tuple and Array Types**: `Pair`, `FixedArray`
- **Easy Integration**: Designed to work seamlessly with Laravel.
- **PHP 8.3 Compatibility**: Leverages the latest PHP features for performance and security.

## Installation

To install the package, use Composer:

```bash
composer require nejcc/php-custom-types
```

## Usage

### Custom Integer Types

#### `i32` (32-bit Signed Integer)

```php
use Nejcc\CustomTypes\Types\Integer\i32;

$number = new i32(123456);
echo $number->getValue(); // Output: 123456
```

## Running Tests

To run the unit tests for this package, ensure that you have PHPUnit installed and run:

```bash
./vendor/bin/phpunit
```

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
