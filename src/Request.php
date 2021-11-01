<?php

namespace Coderjerk\ElephantBird;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

/**
 * Handles http requests to the Twitter API.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class Request
{
    protected $credentials;

    protected $base_uri = 'https://api.twitter.com/2/';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function authorisedRequest($http_method, $path, $params, $data = null, $stream = false, $signed = false)
    {
        return $signed === false ? $this->bearerTokenRequest($http_method, $path, $params, $data, $stream) : $this->userContextRequest($http_method, $path, $params, $data, $stream);
    }

    /**
     * OAuth 2 bearer token request
     *
     * @param string $http_method
     * @param string $path
     * @param array $params
     * @param array $data
     * @param boolean $stream
     *
     * @return object|exception
     */
    public function bearerTokenRequest($http_method, $path, $params, $data = null, $stream = false)
    {
        $bearer_token = $this->credentials['bearer_token'];

        $client = new Client([
            'base_uri' => $this->base_uri
        ]);

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $bearer_token,
                'Accept'        => 'application/json',
            ];

            $request  = $client->request($http_method, $path, [
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
        } catch (ServerException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }


    /**
     * Signed requests for logged in users
     * using OAuth 1
     *
     * @param array $credentials
     * @param string $http_method
     * @param string $path
     * @param array $params
     * @param array $data
     * @param boolean $stream
     * @return object|exception
     */
    public function userContextRequest($http_method, $path, $params, $data = null, $stream = false)
    {
        $path = 'https://api.twitter.com/2/' . $path;

        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => $this->credentials['consumer_key'],
            'consumer_secret' => $this->credentials['consumer_secret'],
            'token'           => $this->credentials['token_identifier'],
            'token_secret'    => $this->credentials['token_secret']
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => $this->base_uri,
            'handler' => $stack
        ]);

        try {
            $request  = $client->request($http_method, $path, [
                'auth' => 'oauth',
                'query' => $params,
                'json' => $data
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
            return $e;
        } catch (ServerException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }
}
