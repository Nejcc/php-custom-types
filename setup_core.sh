#!/bin/bash

# Function to create a file and populate it if it doesn't exist, or prompt for overwrite
create_file() {
    local file_path=$1
    local content=$2

    if [ -f "$file_path" ]; then
        read -p "$file_path exists. Do you want to overwrite it? (y/n): " choice
        if [ "$choice" != "y" ]; then
            echo "Skipping $file_path"
            return
        fi
    fi

    echo "Creating $file_path..."
    echo "$content" > "$file_path"
}

# Create necessary directories
echo "Creating core directories..."
mkdir -p src/Types/Integer
mkdir -p src/Types/Float
mkdir -p src/Types/Char
mkdir -p src/Types/Bool
mkdir -p src/Types/String
mkdir -p src/Types/Compound
mkdir -p src/Types/Nullable
mkdir -p tests/Integer
mkdir -p tests/Float
mkdir -p tests/Char
mkdir -p tests/Bool
mkdir -p tests/String
mkdir -p tests/Compound

# Create composer.json file
composer_content=$(cat <<EOL
{
  "name": "nejcc/php-custom-types",
  "description": "A Laravel package providing custom data types like i8, u8, i32, u32, f32, etc.",
  "type": "library",
  "license": "MIT",
  "authors": [
    {
      "name": "Nejc",
      "email": "your-email@example.com"
    }
  ],
  "require": {
    "php": ">=8.3"
  },
  "require-dev": {
    "phpunit/phpunit": "^10.0"
  },
  "autoload": {
    "psr-4": {
      "Nejcc\\\\CustomTypes\\\\Types\\\\Integer\\\\": "src/Types/Integer/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Float\\\\": "src/Types/Float/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Char\\\\": "src/Types/Char/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Bool\\\\": "src/Types/Bool/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\String\\\\": "src/Types/String/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Compound\\\\": "src/Types/Compound/",
      "Nejcc\\\\CustomTypes\\\\Types\\\\Nullable\\\\": "src/Types/Nullable/"
    }
  },
  "extra": {
    "laravel": {
      "providers": [
        "Nejcc\\\\CustomTypes\\\\CustomTypesServiceProvider"
      ]
    }
  },
  "minimum-stability": "stable",
  "prefer-stable": true
}
EOL
)
create_file "composer.json" "$composer_content"

# Create CustomTypesServiceProvider.php
service_provider_content=$(cat <<EOL
<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes;

use Illuminate\Support\ServiceProvider;

final class CustomTypesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.                               Services
     * --------------------------------------------------------------------------
     * This method binds custom type classes to the service container 
     * and makes them available throughout the Laravel application.
     */
    public function register(): void
    {
        // Register custom types or bindings here
    }

    /**
     * Bootstrap any package services.                                  Bootstraps
     * --------------------------------------------------------------------------
     * This method is used to bootstrap any package-specific services, 
     * such as publishing configuration files or performing other 
     * necessary startup tasks for the package.
     */
    public function boot(): void
    {
        // Bootstrapping services for the package
    }
}
EOL
)
create_file "src/CustomTypesServiceProvider.php" "$service_provider_content"
