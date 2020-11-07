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
     * @param String $httpMethod
     * @param String $uri
     * @param Array $params
     * @param Array $data
     * @param Boolean $stream
     *
     * @return Object|Exception
     */
    public static function makeRequest($httpMethod, $uri, $params, $data = null, $stream = false)
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
            d($e);
            d($e->getRequest()->getBody()->getContents());
            d($e->getResponse()->getBody()->getContents());
        }
    }
}