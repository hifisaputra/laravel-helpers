<?php

namespace Fei77\LaravelHelpers\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelHelpers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LaravelHelpers';
    }
}
