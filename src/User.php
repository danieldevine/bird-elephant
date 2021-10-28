<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Users\UserLookup;
use Coderjerk\ElephantBird\Users\FollowsLookup;
use Coderjerk\ElephantBird\Users\BlocksLookup;

class User
{
    protected $credentials;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
        $this->user_lookup = new UserLookup($this->credentials);
        $this->follows_lookup = new FollowsLookup($this->credentials);
        $this->blocks_lookup = new BlocksLookup($this->credentials);
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
        return $this->blocks_lookup->getBlocks($this->username, $params);
    }
}
