<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\ApiBase;
use Coderjerk\ElephantBird\Users\Follows;
use Coderjerk\ElephantBird\Users\Blocks;

class User extends ApiBase
{
    protected $credentials;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
        $this->follows = new Follows($this->credentials, $this->username);
        $this->blocks = new Blocks($this->credentials, $this->username);
    }

    /**
     * Gets a Twitter user's followers
     *
     * @param array $params
     * @return object
     */
    public function followers($params = [])
    {
        return $this->follows->getFollowers($params);
    }

    /**
     * Gets a Twitter users followed accounts
     *
     * @param array $params
     * @return object
     */
    public function following($params = [])
    {
        return $this->follows->getFollowing($params);
    }

    public function follow($target_username)
    {
        return $this->follows->follow($target_username);
    }

    public function unfollow($target_username)
    {
        return $this->follows->unfollow($this->username, $target_username);
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
        return $this->blocks->lookup($params);
    }

    /**
     * Blocks a given user
     *
     * @param string  $target_username
     * @return object|exception
     */
    public function block($target_username)
    {
        return $this->blocks->block($target_username);
    }

    /**
     * Unblocks a given user
     *
     * @param string $target_username
     * @return object|exception
     */
    public function unblock($target_username)
    {
        return $this->blocks->unblock($this->username, $target_username);
    }
}
