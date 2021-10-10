<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Users\UserLookup;
use Coderjerk\ElephantBird\Users\FollowsLookup;

class User
{
    public function __construct($username)
    {
        $this->username = $username;
        $this->user_lookup = new UserLookup;
        $this->follows_lookup = new FollowsLookup;
    }

    /**
     * Returns a Twitter user's followers
     *
     * @param array $params
     * @return object
     */
    public function followers($params = array())
    {
        return $this->follows_lookup->getFollowers($this->username, $params);
    }

    public function following($params = array())
    {
        return $this->follows_lookup->getFollowing($this->username, $params);
    }
}
