<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\User;
use Coderjerk\ElephantBird\Tweets;
use Coderjerk\ElephantBird\Compliance;
use Coderjerk\ElephantBird\Lists;
use Coderjerk\ElephantBird\Spaces;
use Coderjerk\ElephantBird\Request;


class ElephantBird
{
    /**
     * Twitter credentials.
     *
     * @var array
     */
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Access any endpoint
     *
     * Raw access for those who prefer to control all the
     * variables in exchange for a lack of convinience.
     *
     * @param string $endpoint
     * @param string $http_method
     * @param array $params query parameters
     * @param boolean $signed are we using user context or bearer token? defaults to bearer
     * @param array $data post/put data
     * @param boolean $stream sometimes you may need or wish to stream the results.
     * @return object|exception
     */
    public function call($endpoint, $http_method, $params, $signed = false,  $data = null, $stream = false)
    {
        $request = new Request($this->credentials);

        if ($signed === false) {
            return $request->bearerTokenRequest($http_method, $endpoint, $params, $data, $stream);
        } else {
            return $request->signedRequest($this->credentials, $http_method, $endpoint, $params, $data, $stream);
        }
    }

    /**
     * Access the user endpoints
     *
     * @param string $handle
     * @return object
     */
    public function user($handle)
    {
        return new User($this->credentials, $handle);
    }

    /**
     * Access Tweet endpoints
     *
     * @param array $args
     * @return object
     */
    public function tweets($params)
    {
        return new Tweets($this->credentials, $params);
    }

    /**
     * Access compliance endpoints
     *
     * @return object
     */
    public function compliance()
    {
        return new Compliance($this->credentials);
    }

    /**
     * Access list endpoints
     *
     * @return object
     */
    public function lists()
    {
        return new Lists($this->credentials);
    }
}
