<?php

namespace Strebl\Inetworx\Test\Integration;

use Strebl\Inetworx\InetworxFacade;
use Strebl\Inetworx\InetworxServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            InetworxServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Inetworx' => InetworxFacade::class,
        ];
    }
}
