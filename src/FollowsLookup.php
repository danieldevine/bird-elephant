<?php

namespace Coderjerk\ElephantBird;

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

    public $default_params = [
        'max_results' => 10
    ];

    public function getFollowers($id, $params)
    {
        return $this->getFollows($id, $params, '/followers');
    }

    public function getFollowing($id, $params)
    {
        return $this->getFollows($id, $params, '/following');
    }

    protected function getFollows($id, $params, $endpoint)
    {
        $path = $this->uri . '/' .  $id . $endpoint;

        $params = array_merge($this->default_params, $params);

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }
}
