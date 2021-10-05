<?php

namespace Coderjerk\ElephantBird\Users;

use Coderjerk\ElephantBird\Request;

/**
 * Gets followers and following
 * of a given Twitter user.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 * @since 1.5.0
 */
class FollowsLookup
{
    /**
     * The endpoint
     *
     * @var string
     */
    public $uri = 'users';

    /**
     * Default query parameters
     *
     * @var array
     */
    public $default_params = [
        'max_results' => 10,
    ];

    /**
     * Returns a given user's followers.
     *
     * @param string $id
     * @param array $params
     * @return object
     */
    public function getFollowers($id, $params)
    {
        return $this->getFollows($id, $params, '/followers');
    }

    /**
     * Returns a given user's followed accounts
     *
     * @param string $id
     * @param array $params
     * @return object
     */
    public function getFollowing($id, $params)
    {
        return $this->getFollows($id, $params, '/following');
    }

    /**
     * Gets data from the follows endpoint
     *
     * @param string $id
     * @param array $params
     * @param string $endpoint
     * @return object
     */
    protected function getFollows($id, $params, $endpoint)
    {
        $path = $this->uri . '/' .  $id . $endpoint;

        $params = array_merge($this->default_params, $params);

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }
}
