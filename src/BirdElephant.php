<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\User;
use Coderjerk\BirdElephant\Tweets;
use Coderjerk\BirdElephant\Compliance;
use Coderjerk\BirdElephant\Lists;
use Coderjerk\BirdElephant\Spaces;
use Coderjerk\BirdElephant\Me;


class BirdElephant
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
     * Access User endpoints
     *
     * @param string $username
     * @return User
     */
    public function user(string $username): User
    {
        return new User($this->credentials, $username);
    }

    /**
     * Access multiple User endpoints
     *
     * @return Users
     */
    public function users(): Users
    {
        return new Users($this->credentials);
    }

    /**
     * Access Tweet endpoints
     *
     * @return Tweets
     */
    public function tweets(): Tweets
    {
        return new Tweets($this->credentials);
    }

    /**
     * Access Compliance endpoints
     *
     * @return Compliance
     */
    public function compliance(): Compliance
    {
        return new Compliance($this->credentials);
    }

    /**
     * Access List endpoints
     *
     * @return Lists
     */
    public function lists(): Lists
    {
        return new Lists($this->credentials);
    }

    /**
     * Access Spaces endpoints
     *
     * @return Spaces
     */
    public function spaces(): Spaces
    {
        return new Spaces($this->credentials);
    }

    /**
     * Get information about the logged in user
     *
     * @return Me
     */
    public function me(): Me
    {
        return new Me($this->credentials);
    }

    /**
     * Access any endpoint.
     *
     * 'Raw' access for those who prefer to control all the
     * variables in exchange for a lack of convenience.
     *
     * @param array $credentials - array of credentials
     * @param string $http_method - 'GET'|'POST|'PUT'|'DELETE'
     * @param string $endpoint - the endpoint you want to call
     * @param array $params - query parameters
     * @param array|null $data - post/put data
     * @param boolean $stream - streaming endpoint if true, default false
     * @param boolean $signed - bearer auth or user context auth, default bearer
     * @return object
     */
    public function call(
        array  $credentials,
        string $http_method,
        string $endpoint,
        array  $params,
        array  $data = null,
        bool   $stream = false,
        bool   $signed = false
    ): object {
        $request = new Request($credentials);
        return $request->authorisedRequest($http_method, $endpoint, $params, $data, $stream, $signed);
    }
}
