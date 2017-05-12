<?php

namespace Strebl\Inetworx\Test\Integration;

use Inetworx;

class InetworxServiceProviderTest extends TestCase
{
    /** @test */
    public function test_the_facade()
    {
        $credit = Inetworx::credit();

        $this->assertInternalType('int', $credit);
        $this->assertGreaterThan(1, $credit);
    }
}
