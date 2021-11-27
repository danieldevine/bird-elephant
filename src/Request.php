<?php

namespace Coderjerk\BirdElephant;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;

/**
 * Handles http requests to the Twitter API.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class Request
{
    protected array $credentials;

    protected string $base_uri = 'https://api.twitter.com/';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param string $http_method
     * @param string $path
     * @param array|null $params
     * @param array|null $data
     * @param false $stream
     * @param false $signed
     * @param string|null $version
     * @return object
     * @throws GuzzleException
     */
    public function authorisedRequest(string $http_method, string $path, ?array $params, ?array $data = null, bool $stream = false, bool $signed = false, ?string $version = '2'): object
    {
        return $signed === false ? $this->bearerTokenRequest($http_method, $path, $params, $data, $stream, $version) : $this->userContextRequest($http_method, $path, $params, $data, $stream, $version);
    }

    /**
     * OAuth 2 bearer token request
     *
     * @param string $http_method
     * @param string $path
     * @param array|null $params
     * @param array|null $data
     * @param boolean $stream
     * @param string|null $version
     * @return object
     * @throws GuzzleException
     */
    public function bearerTokenRequest(string $http_method, string $path, ?array $params, ?array $data = null, bool $stream = false, ?string $version = '2'): object
    {
        $bearer_token = $this->credentials['bearer_token'];

        $client = new Client([
            'base_uri' => $this->base_uri . $version . '/'
        ]);

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $bearer_token,
                'Accept'        => 'application/json',
            ];

            //thanks to Guzzle's lack of flexibility with url encoding we have to manually set up the query to preserve colons.
            if ($params) {
                $params = http_build_query($params);
                $path = $path . '?' . str_replace('%3A', ':', $params);
            }

            $request  = $client->request($http_method, $path, [
                'headers' => $headers,
                'json'    => $data ? $data : null,
                'stream'  => $stream === true
            ]);

            //if we're streaming the response, echo otherwise return
            if ($stream === true) {
                $body = $request->getBody();
                while (!$body->eof()) {
                    echo json_decode($body->read(1300));
                }
            } else {
                $body = $request->getBody()->getContents();
                return json_decode($body);
            }
        } catch (ClientException | ServerException $e) {
            throw $e;
        }
    }

    /**
     * Signed requests for logged in users
     * using OAuth 1
     *
     * @param string $http_method
     * @param string $path
     * @param array|null $params
     * @param array|null $data
     * @param boolean $stream
     * @param string|null $version
     * @return object
     * @throws GuzzleException
     */
    public function userContextRequest(string $http_method, string $path, ?array $params, ?array $data = null, bool $stream = false, ?string $version = '2'): object
    {
        $path = $this->base_uri . $version . '/' . $path;


        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => $this->credentials['consumer_key'],
            'consumer_secret' => $this->credentials['consumer_secret'],
            'token'           => $this->credentials['token_identifier'],
            'token_secret'    => $this->credentials['token_secret']
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => $this->base_uri . $version . '/',
            'handler' => $stack
        ]);

        try {
            $request  = $client->request($http_method, $path, [
                'auth' => 'oauth',
                'query' => $params,
                'json' => $data,
                // 'debug' => true
            ]);

            //if we're streaming the response, echo otherwise return
            if ($stream === true) {

                $body = $request->getBody();
                while (!$body->eof()) {
                    echo json_decode($body->read(1300));
                }
            } else {
                $body = $request->getBody()->getContents();
                return json_decode($body);
            }
        } catch (ClientException | ServerException $e) {
            throw $e;
        }
    }

    /**
     * @param $media
     * @throws GuzzleException
     */
    public function uploadMedia($media)
    {
        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => $this->credentials['consumer_key'],
            'consumer_secret' => $this->credentials['consumer_secret'],
            'token'           => $this->credentials['token_identifier'],
            'token_secret'    => $this->credentials['token_secret']
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => 'https://upload.twitter.com/1.1/',
            'handler' => $stack
        ]);

        try {
            $request  = $client->request('POST', 'media/upload.json', [
                'auth' => 'oauth',
                'multipart' => [
                    [
                        'name'     => 'media_data',
                        'contents' => base64_encode(file_get_contents($media))
                    ]
                ]
            ]);

            $body = $request->getBody()->getContents();
            return json_decode($body);
        } catch (ClientException | ServerException $e) {
            throw $e;
        }
    }
}
