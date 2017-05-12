<?php

namespace Strebl\Inetworx;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Strebl\Inetworx\InetworxClient
 */
class InetworxFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'inetworx-client';
    }
}
