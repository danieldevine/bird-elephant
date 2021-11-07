<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Users\UserLookup;

class Users
{
    protected $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
        $this->userLookup = new UserLookup($this->credentials);
    }

    public function lookup($usernames, $params = [])
    {
        return $this->userLookup->getMultipleUsersByUsername($usernames, $params);
    }
}
