<?php namespace Cyvelnet\Billplz\Transporters;

use GuzzleHttp\Exception\ClientException;

/**
 * Class BaseTransporter
 * @package Cyvelnet\Billplz\Transporters
 */
abstract class BaseTransporter
{
    /**
     * send post request to Billplz
     * @param $url
     * @param $body
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function sendPost($url, $body)
    {
        return $this->send('post', $url, $body);
    }

    /**
     * send get request to Billplz
     * @param $url
     * @param null $body
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function sendGet($url, $body = null)
    {
        return $this->send('get', $url, $body);
    }

    /**
     * send delete request to Billplz
     * @param $url
     * @param null $body
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function sendDelete($url, $body = null)
    {
        return $this->send('delete', $url, $body);
    }

    /**
     * send request
     * @param $type
     * @param $url
     * @param $body
     * @return bool|object
     */
    protected function send($type, $url, $body = [])
    {
        try {

            $response = $this->client->$type($url, ['auth' => [$this->apiKey, null], 'form_params' => $body]);
            $this->success = true;

        } catch (ClientException $e) {

            $response = $e->getResponse();

            $this->log->error('The url ' . $response->getEffectiveUrl() . ' causes a '
                . $response->getStatusCode() . ' ' . $response->getReasonPhrase());
        }

        return new TransportResponse($response);

    }
}
