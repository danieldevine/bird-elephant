<?php

namespace Coderjerk\ElephantBird;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

/**
 * Handles http requests to the Twitter API.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 */
class Request
{
    protected $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * OAuth 2 bearer token request
     *
     * @param string $http_method
     * @param string $uri
     * @param array $params
     * @param array $data
     * @param boolean $stream
     *
     * @return object|exception
     */
    public function bearerTokenRequest($http_method, $uri, $params, $data = null, $stream = false)
    {
        $bearer_token = $this->credentials['bearer_token'];

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

            //if we're streaming the response, echo otherwise return
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

            return $e->getResponse()->getBody()->getContents();
        }
    }


    /**
     * Signed requests for logged in users
     *
     * @param array $credentials
     * @param string $http_method
     * @param string $uri
     * @param array $params
     * @param array $data
     * @param boolean $stream
     * @return object|exception
     */
    public function signedRequest($credentials, $http_method, $uri, $params, $data = null, $stream = false)
    {
        $uri = 'https://api.twitter.com/2/' . $uri;

        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => $credentials['consumer_key'],
            'consumer_secret' => $credentials['consumer_secret'],
            'token'           => $credentials['token_identifier'],
            'token_secret'    => $credentials['token_secret']
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => 'https://api.twitter.com/2/',
            'handler' => $stack
        ]);

        try {
            $request  = $client->request($http_method, $uri, ['auth' => 'oauth']);

            //if we're streaming the response, echo otherwise return
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

            return $e->getResponse()->getBody()->getContents();
        }
    }
}
