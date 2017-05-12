<?php

namespace Strebl\Inetworx;

use GuzzleHttp\Client;
use Strebl\Inetworx\Exceptions\ApiErrorException;

class InetworxClient
{
    /**
     * @var string
     */
    protected $baseUrl = 'https://sms.inetworx.ch/';

    /**
     * @var string
     */
    protected $broadcastUrl = 'smsapp/sendsms.php';

    /**
     * @var string
     */
    protected $optionsUrl = 'smsapp/options.php';

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $apiPassword;

    /**
     * @var string
     */
    protected $apiUsername;

    /**
     * Inetworx Client Constructor.
     *
     * @param string $authHeaderUsername
     * @param string $authHeaderPassword
     * @param string $apiUsername
     * @param string $apiPassword
     * @param $client
     */
    public function __construct($authHeaderUsername, $authHeaderPassword, $apiUsername, $apiPassword, $client = null)
    {
        if ($client) {
            $this->httpClient = $client;
        } else {
            $this->createHttpClient($authHeaderUsername, $authHeaderPassword);
        }

        $this->apiUsername = $apiUsername;
        $this->apiPassword = $apiPassword;
    }

    /**
     * Send the message.
     *
     * @param $phoneNumber
     * @param $message
     * @param $fromNumber
     *
     * @return array $response
     */
    public function send($phoneNumber, $message, $fromNumber)
    {
        return $this->sendRequest($this->getBroadcastUrl(), [
            'sender'  => $fromNumber,
            'rcpt'    => $phoneNumber,
            'msgbody' => $message,
            'coding'  => 2,
        ]);
    }

     /**
      * Get the remaining SMS credits.
      *
      * @throws ApiErrorException
      *
      * @return int $credit
      */
     public function credit()
     {
         return (int) $this->sendRequest($this->getOptionsUrl(), ['option'  => 'quota'])['body'];
     }

    /**
     * @param $url
     * @param $params
     *
     * @throws ApiErrorException
     *
     * @return array
     */
    protected function sendRequest($url, $params)
    {
        $response = $this
             ->getHttpClient()
             ->post($url, [
                 'form_params' => array_merge([
                     'user'    => $this->apiUsername,
                     'pass'    => $this->apiPassword,
                 ], $params),
             ]);

        if ($response->getStatusCode() !== 200 || $this->responseCodeFromBody($response) !== 200) {
            throw new ApiErrorException(
                 $this->responseBody($response)
             );
        }

        return [
             'body'      => $this->responseBody($response),
             'full_body' => (string) $response->getBody(),
             'status'    => $response->getStatusCode(),
             'message'   => $response->getReasonPhrase(),
         ];
    }

    /**
     * The Inetworx API doesn't respond with a useful HTTP Status Code if the request fails.
     * It puts the status code into the response body.
     * for example: 404: Invalid Option.
     *
     * @return int $code
     */
    protected function responseCodeFromBody($response)
    {
        return (int) explode(':', (string) $response->getBody())[0];
    }

    /**
     * Inetworx puts the status code in the response body too.
     * Because of that, we have to parse the answer.
     *
     * @param $response
     *
     * @return string $body
     */
    protected function responseBody($response)
    {
        return trim(explode(':', (string) $response->getBody())[1]);
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getBroadcastUrl()
    {
        return $this->broadcastUrl;
    }

    /**
     * @param string $broadcastUrl
     */
    public function setBroadcastUrl($broadcastUrl)
    {
        $this->broadcastUrl = $broadcastUrl;
    }

    /**
     * @return string
     */
    public function getOptionsUrl()
    {
        return $this->optionsUrl;
    }

    /**
     * @param string $optionsUrl
     */
    public function setOptionsUrl($optionsUrl)
    {
        $this->optionsUrl = $optionsUrl;
    }

    /**
     * @return Client
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param $client
     *
     * @return void
     */
    protected function setHttpClient($client)
    {
        $this->httpClient = $client;
    }

    /**
     * @return void
     */
    protected function createHttpClient($authHeaderUsername, $authHeaderPassword)
    {
        $this->httpClient = new Client([
            'base_uri' => $this->getBaseUrl(),
            'auth'     => [
                $authHeaderUsername,
                $authHeaderPassword,
            ],
        ]);
    }
}
