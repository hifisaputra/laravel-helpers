<?php

namespace Fei77\LaravelHelper\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LaravelHelper';
    }
}
