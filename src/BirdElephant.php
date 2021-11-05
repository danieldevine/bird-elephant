<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\User;
use Coderjerk\BirdElephant\Tweets;
use Coderjerk\BirdElephant\Compliance;
use Coderjerk\BirdElephant\Lists;
use Coderjerk\BirdElephant\Spaces;
use Coderjerk\BirdElephant\Tweet\Tweet;


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

    public function tweet()
    {
        return new Tweet;
    }
}
