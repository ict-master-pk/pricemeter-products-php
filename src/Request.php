<?php

namespace Pricemeter;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class Request
{
    /**
     * Making API call to pricemeter
     *
     * @param $method
     * @param $uri
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public static function make($method, $uri, $params = []) : array
    {
        $client = new Client([
            'base_uri' => 'https://api.pricemeter.pk',
            'verify' => false,
        ]);

        $response = $client->request($method, $uri, [
            'form_params' => $params
        ]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        } else {
            throw new \Exception("Got error while making API call with status code {$response->getStatusCode()}");
        }
    }
}