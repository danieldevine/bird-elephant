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
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Utility function - access any endpoint.
     *
     * @param string $endpoint
     * @param string $http_method
     * @param array $params
     * @param boolean $signed
     * @param array $data
     * @param boolean $stream
     * @return object|exception
     */
    public function twitter($endpoint, $http_method, $params, $signed = false,  $data = null, $stream = false)
    {
        $request = new Request($this->credentials);

        if ($signed === false) {
            return $request->bearerTokenRequest($http_method, $endpoint, $params, $data, $stream);
        } else {
            return $request->signedRequest($this->credentials, $http_method, $endpoint, $params, $data, $stream);
        }
    }

    public function user($handle)
    {
        return new User($this->credentials, $handle);
    }

    public function tweets($args)
    {
        return new Tweets($this->credentials, $args);
    }

    public function compliance()
    {
        return new Compliance($this->credentials);
    }

    public function lists()
    {
        return new Lists($this->credentials);
    }
}
