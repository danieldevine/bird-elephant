<?php

namespace Coderjerk\ElephantBird;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Handles our http requests to the Twitter API.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 */
class Request
{
    /**
     * @param string $http_method
     * @param string $uri
     * @param array $params
     * @param array $data
     * @param boolean $stream
     *
     * @return object|exception
     */
    public static function makeRequest($http_method, $uri, $params, $data = null, $stream = false)
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

            $request  = $client->request($http_method, $uri, [
                'query'   => $params,
                'headers' => $headers,
                'json'    => $data ? $data : null,
                'stream'  => $stream === true ? true : false
            ]);

            if ($stream === true) {
                $body = $request->getBody();
                while (!$body->eof()) {
                    echo json_decode($body->read(1300));
                }
            } else {
                $body = $request->getBody()->getContents();
                $response = json_decode($body);

                return $response;
            }
        } catch (ClientException $e) {

            return $e->getRequest()->getBody()->getContents();
        }
    }
}
