<?php

namespace Strebl\Inetworx\Test\Integration;

use PHPUnit\Framework\TestCase;
use Strebl\Inetworx\InetworxClient;

class InetworxClientTest extends TestCase
{
    /**
     * @var InetworxClient
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = new InetworxClient(
            getenv('INETWORX_AUTH_HEADER_USERNAME'),
            getenv('INETWORX_AUTH_HEADER_PASSWORD'),
            getenv('INETWORX_API_USERNAME'),
            getenv('INETWORX_API_PASSWORD')
        );
    }

    /** @test */
    public function it_fetches_the_remaining_credit()
    {
        $credit = $this->client->credit();

        $this->assertInternalType('int', $credit);
        $this->assertGreaterThan(1, $credit);
    }

    /**
     * @test
     * @group costsMoney
     */
    public function it_sends_a_message()
    {
        $response = $this->client->send(getenv('TEST_NUMBER'), 'Test Message', 'Strebl');

        $this->assertEquals(200, $response['statusCode']);
    }
}
