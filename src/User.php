<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\ApiBase;
use Coderjerk\ElephantBird\Users\Follows;
use Coderjerk\ElephantBird\Users\Blocks;
use Coderjerk\ElephantBird\Users\Mutes;

class User extends ApiBase
{
    protected $credentials;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
        $this->follows = new Follows($this->credentials, $this->username);
        $this->blocks = new Blocks($this->credentials, $this->username);
        $this->mutes = new Mutes($this->credentials, $this->username);
    }

    /**
     * Gets a Twitter user's followers
     *
     * @param array $params
     * @return object|exception
     */
    public function followers($params = [])
    {
        return $this->follows->getFollowers($params);
    }

    /**
     * Gets a Twitter users followed accounts
     *
     * @param array $params
     * @return object|exception
     */
    public function following($params = [])
    {
        return $this->follows->getFollowing($params);
    }

    /**
     * Foiloes a given user
     *
     * @param string $target_username
     * @return object|exception
     */
    public function follow($target_username)
    {
        return $this->follows->follow($target_username);
    }

    /**
     * Unfollows a given user
     *
     * @param string $target_username
     * @return object|exception
     */
    public function unfollow($target_username)
    {
        return $this->follows->unfollow($target_username);
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
        return $this->blocks->unblock($target_username);
    }

    /**
     * Gets the muteed accounts of a Twitter user.
     *
     * @param array $credentials
     * @param array $params
     * @return object
     */
    public function mutes($params = [])
    {
        return $this->mutes->lookup($params);
    }

    /**
     * Mutes a given user
     *
     * @param string  $target_username
     * @return object|exception
     */
    public function mute($target_username)
    {
        return $this->mutes->mute($target_username);
    }

    /**
     * Unmutes a given user
     *
     * @param string $target_username
     * @return object|exception
     */
    public function unmute($target_username)
    {
        return $this->mutes->unmute($target_username);
    }
}
