<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Users\UserLookup;

class Users
{
    protected array $credentials;
    private UserLookup $userLookup;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
        $this->userLookup = new UserLookup($this->credentials);
    }

    /**
     * @param array $usernames
     * @param array $params
     * @return object
     */
    public function lookup(array $usernames, array $params = []): object
    {
        return $this->userLookup->getMultipleUsersByUsername($usernames, $params);
    }
}
