<?php

namespace Coderjerk\TwitterSearch;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request
{
    /**
     * @param String $method http method
     * @param String $uri
     * @param Array $query
     *
     * @return Object|Exception
     */
    public static function makeRequest($method, $uri, $query)
    {
        $bearer_token = $_ENV['TWITTER_BEARER_TOKEN'];

        $client = new Client([
            'base_uri' => 'https://api.twitter.com/2/'
        ]);

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $bearer_token,
                'Accept'        => 'application/json',
            ];

            $request  = $client->request($method, $uri, [
                'query'   => $query,
                'headers' => $headers
            ]);

            $body = $request->getBody()->getContents();
            $response = json_decode($body);
            return $response;
        } catch (ClientException $e) {
            $e->getRequest()->getBody()->getContents();
            $e->getResponse()->getBody()->getContents();
        }
    }
}