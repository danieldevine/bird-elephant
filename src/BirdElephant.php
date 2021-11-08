<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\User;
use Coderjerk\BirdElephant\Tweets;
use Coderjerk\BirdElephant\Compliance;
use Coderjerk\BirdElephant\Lists;
use Coderjerk\BirdElephant\Spaces;


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
}
