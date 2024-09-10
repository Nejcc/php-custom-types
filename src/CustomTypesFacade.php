<?php

namespace Nejcc\CustomTypes;

use Illuminate\Support\Facades\Facade;

class CustomTypesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'CustomTypes';
    }
}