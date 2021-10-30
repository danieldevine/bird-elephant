<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\ApiBase;
use Coderjerk\ElephantBird\Users\UserLookup;
use Coderjerk\ElephantBird\Users\FollowsLookup;
use Coderjerk\ElephantBird\Users\Blocks;

class User extends ApiBase
{
    protected $credentials;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
        $this->user_lookup = new UserLookup($this->credentials);
        $this->follows_lookup = new FollowsLookup($this->credentials);
        $this->blocks = new Blocks($this->credentials);
    }

    /**
     * Gets a Twitter user's followers
     *
     * @param array $params
     * @return object
     */
    public function followers($params = [])
    {
        return $this->follows_lookup->getFollowers($this->username, $params);
    }

    /**
     * Gets a Twitter users followed accouts
     *
     * @param array $params
     * @return object
     */
    public function following($params = [])
    {
        return $this->follows_lookup->getFollowing($this->username, $params);
    }

    /**
     * Gets the blocked accounts of a Twitter user.
     *
     * @param array $credentials
     * @param array $params
     * @return object
     */
    public function blocks($params = [])
    {
        return $this->blocks->lookup($this->username, $params);
    }

    public function block($target_username)
    {
        return $this->blocks->block($this->username, $target_username);
    }

    public function unblock($target_username)
    {
        return $this->blocks->unblock($this->username, $target_username);
    }
}
