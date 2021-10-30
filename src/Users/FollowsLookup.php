<?php

namespace Coderjerk\ElephantBird\Users;

use Coderjerk\ElephantBird\ApiBase;

/**
 * Gets followers and following
 * of a given Twitter user.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 * @since 1.5.0
 */
class FollowsLookup extends ApiBase
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

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Returns a given user's followers.
     *
     * @param string $username
     * @param array $params
     * @return object
     */
    public function getFollowers($username, $params)
    {
        return $this->getFollows($username, $params, '/followers');
    }

    /**
     * Returns a given user's followed accounts
     *
     * @param string $username
     * @param array $params
     * @return object
     */
    public function getFollowing($username, $params)
    {
        return $this->getFollows($username, $params, '/following');
    }

    /**
     * Gets data from the follows endpoint
     *
     * @param string $username
     * @param array $params
     * @param string $endpoint
     * @return object
     */
    protected function getFollows($username, $params, $endpoint)
    {
        $id = $this->getUserId($username, $this->credentials);
        $path = $this->uri . '/' .  $id . $endpoint;
        $params = array_merge($this->default_params, $params);

        return $this->get(
            $this->credentials,
            $path,
            $params,
            $data = null,
            $stream = false,
            $signed = false
        );
    }
}
