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
     * Access User endpoints
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
    public function tweets()
    {
        return new Tweets($this->credentials);
    }

    /**
     * Access Compliance endpoints
     *
     * @return object
     */
    public function compliance()
    {
        return new Compliance($this->credentials);
    }

    /**
     * Access List endpoints
     *
     * @return object
     */
    public function lists()
    {
        return new Lists($this->credentials);
    }

    /**
     * Access Spaces endpoints
     *
     * @return void
     */
    public function spaces()
    {
        return new Spaces($this->credentials);
    }
}
