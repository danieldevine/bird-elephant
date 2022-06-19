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
     * @param string|null $api_version
     * @return object
     * @throws GuzzleException
     */
    public function authorisedRequest(
        string $http_method,
        string $path,
        ?array $params,
        ?array $data = null,
        bool $stream = false,
        bool $signed = false,
        ?string $api_version = '2'
    ): object {

        $args = [
            'http_method' => $http_method,
            'path'        => $path,
            'params'      => $params,
            'data'        => $data,
            'stream'      => $stream,
            'api_version' => $api_version
        ];

        if ($signed === false) {
            $token = $this->credentials['bearer_token'];
            return $this->bearerTokenRequest($args, $token);
        }

        if (isset($this->credentials['auth_token'])) {
            $token = $this->credentials['auth_token'];
            return $this->bearerTokenRequest($args, $token);
        }

        return $this->userContextRequest($args);
    }

    /**
     * OAuth 2 bearer token request
     *
     * @param array $args
     * @param string $token
     * @return object
     * @throws GuzzleException
     */
    public function bearerTokenRequest($args, $token): object
    {
        $client = new Client([
            'base_uri' => $this->base_uri . $args['api_version'] . '/'
        ]);

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ];

            $path = $args['path'];

            //thanks to Guzzle's lack of flexibility with url encoding we have to manually set up the query to preserve colons.
            if (isset($args['params'])) {
                $args['params'] = http_build_query($args['params']);
                $path = $args['path'] . '?' . str_replace('%3A', ':', $args['params']);
            }

            if (!isset($args['data'])) {
                $args['data'] === null;
            }

            $request  = $client->request($args['http_method'], $path, [
                'headers' => $headers,
                'json'    => $args['data'],
                'stream'  => $args['stream'] === true
            ]);

            //if we're streaming the response, echo otherwise return
            if ($args['stream'] === true) {
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
     * using OAuth 1.0a - will be deprecated in future in
     * favour of OAuth 2.0 with PKCE
     *
     * @param array $args
     * @return object
     * @throws GuzzleException
     */
    public function userContextRequest($args): object
    {
        $path = $this->base_uri . $args['api_version'] . '/' . $args['path'];

        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => $this->credentials['consumer_key'],
            'consumer_secret' => $this->credentials['consumer_secret'],
            'token'           => $this->credentials['token_identifier'],
            'token_secret'    => $this->credentials['token_secret']
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => $this->base_uri . $args['api_version'] . '/',
            'handler'  => $stack
        ]);

        try {
            $request  = $client->request($args['http_method'], $path, [
                'auth'  => 'oauth',
                'query' => $args['params'],
                'json'  => $args['data'],
                // 'debug' => true
            ]);

            //if we're streaming the response, echo otherwise return
            if ($args['stream'] === true) {

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
