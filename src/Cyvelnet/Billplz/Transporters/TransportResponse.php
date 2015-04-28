<?php namespace Cyvelnet\Billplz\Transporters;


use GuzzleHttp\Message\Response;

/**
 * Class TransportResponse
 * @package Cyvelnet\Billplz\Transporters
 */
class TransportResponse
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @param Response $response
     */
    function __construct(Response $response)
    {

        $this->response = $response;
    }

    /**
     * determine a request has successed
     * @return bool
     */
    public function isSuccess()
    {
        return $this->response->getStatusCode() === 200;
    }

    /**
     * determine a request has failed
     * @return bool
     */
    public function isFailed()
    {
        return $this->response->getStatusCode() !== 200;
    }


    /**
     * get request response
     * @return array
     */
    public function getResponse()
    {
        return $this->response->json();
    }

    /**
     * get request url
     * @return string
     */
    public function getRequestedURL()
    {
        return $this->response->getEffectiveUrl();
    }

    /**
     * @return int|string
     */
    public function getResponseCode()
    {
        return $this->response->getStatusCode();
    }

    /**
     * get the response phrase
     * @return array
     */
    public function getFailedReason()
    {
        if ($this->isFailed()) {
            $error = $this->response->json();

            return (array_key_exists('error', $error) ? $error['error'] : array());

        }

        return null;

    }
}
