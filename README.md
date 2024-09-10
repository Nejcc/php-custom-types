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

## Tree
```
CustomTypes
├── Scalar Types
│   ├── Integer Types
│   │   ├── Signed Integers
│   │   │   ├── i8    (8-bit signed)
│   │   │   ├── i16   (16-bit signed)
│   │   │   ├── i32   (32-bit signed)
│   │   │   ├── i64   (64-bit signed)
│   │   │   └── i128  (128-bit signed)
│   │   └── Unsigned Integers
│   │       ├── u8    (8-bit unsigned)
│   │       ├── u16   (16-bit unsigned)
│   │       ├── u32   (32-bit unsigned)
│   │       ├── u64   (64-bit unsigned)
│   │       └── u128  (128-bit unsigned)
│   ├── Floating-Point Types
│   │   ├── f16       (16-bit floating-point)
│   │   ├── f32       (32-bit floating-point)
│   │   ├── f64       (64-bit floating-point)
│   │   └── f128      (128-bit floating-point)
│   ├── Character Type
│   │   └── Char      (Single Unicode character)
│   └── Boolean Type
│       └── Bool      (Boolean, true or false)
├── Compound Types
│   ├── Tuple
│   │   └── Tuple (Fixed-size collection of heterogeneous values)
│   └── FixedArray
│       └── FixedArray (Fixed-size collection of homogeneous values)
├── String Types
│   ├── StrSlice      (Immutable string slice)
│   └── OwnedString   (Owned, mutable string)
├── Collection Types
│   ├── Vec           (Growable array type)
│   ├── HashMap       (Key-value store)
│   └── HashSet       (Unordered collection of unique values)
├── Custom Types
│   ├── Structs
│   │   └── ExampleStruct (Custom user-defined data structures)
│   └── Enums
│       └── ExampleEnum (Custom enumerations)
├── Smart Pointer Types
│   ├── Box           (Single ownership heap allocation)
│   ├── Rc            (Reference counted pointer)
│   ├── RefCell       (Single-threaded interior mutability)
│   └── Mutex         (Thread-safe interior mutability)
└── Other Types
    ├── Unit          (Represents an empty value or no value)
    └── PhantomData   (Marker for unused generic type parameters)

```

## Usage

### Custom Integer Types

#### `i32` (32-bit Signed Integer)

```php
use Nejcc\CustomTypes\ScalarTypes\Integers\Signed\i32;

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
