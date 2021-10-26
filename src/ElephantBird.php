<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\User;
use Coderjerk\ElephantBird\Tweets;
use Coderjerk\ElephantBird\Compliance;
use Coderjerk\ElephantBird\Lists;
use Coderjerk\ElephantBird\Spaces;

/**
 * Undocumented class
 */
class ElephantBird
{
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
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
