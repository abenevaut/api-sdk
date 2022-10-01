<?php

namespace abenevaut\ApiSdk\Facades;

use abenevaut\ApiSdk\Contracts\ApiProviderNameInterface;
use Illuminate\Support\Facades\Facade;

class Abenevaut extends Facade implements ApiProviderNameInterface
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return self::ABENEVAUT;
    }
}
