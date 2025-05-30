<?php

namespace Ichinya\MoonshineLogin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ichinya\MoonshineLogin\MoonshineLogin
 */
class MoonshineLogin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ichinya\MoonshineLogin\MoonshineLogin::class;
    }
}
