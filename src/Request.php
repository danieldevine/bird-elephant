<?php

namespace Coderjerk\ElephantBird;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Handles our requests to the Twitter API.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 */
class Request
{
    /**
     * @param String $httpMethod http method
     * @param String $uri
     * @param Array $params
     *
     * @return Object|Exception
     */
    public static function makeRequest($httpMethod, $uri, $params)
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

            $request  = $client->request($httpMethod, $uri, [
                'query'   => $params,
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