<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

/**
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class Follows extends ApiBase
{
    /**
     * The endpoint
     *
     * @var string
     */
    public string $uri = 'users';

    /**
     * Default query parameters
     *
     * @var array
     */
    public array $default_params = [
        'max_results' => 10,
    ];

    /**
     * Auth credentials
     *
     * @var array
     */
    protected array $credentials;

    /**
     * A Twitter handle
     *
     * @var string
     */
    protected string $username;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
    }

    /**
     * Returns a given user's followers.
     *
     * @param array $params
     * @return object
     */
    public function getFollowers(array $params): object
    {
        return $this->getFollows($params, '/followers');
    }

    /**
     * Returns a given user's followed accounts
     *
     * @param array $params
     * @return object
     */
    public function getFollowing(array $params): object
    {
        return $this->getFollows($params, '/following');
    }

    /**
     * Gets data from the follows endpoint
     *
     * @param array $params
     * @param string $endpoint
     * @return object
     */
    protected function getFollows(array $params, string $endpoint): object
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = $this->uri . '/' .  $id . $endpoint;
        $params = array_merge($this->default_params, $params);
        return $this->get($this->credentials, $path, $params, $data = null, $stream = false, $signed = false);
    }

    /**
     * Follows a named user
     *
     * @param string $target_username
     * @return object
     * @throws GuzzleException
     */
    public function follow(string $target_username): object
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/following";
        $target_user_id = $this->getUserId($target_username, $this->credentials);
        $data = [
            'target_user_id' => $target_user_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * Unfollows a named user
     *
     * @note - not actually working despite
     * returning the correct response .Reported to Twitter
     *
     * @param string $target_username
     * @return object
     * @throws GuzzleException
     */
    public function unfollow(string $target_username): object
    {
        $id = $this->getUserId($this->username);
        $target_user_id = $this->getUserId($target_username);
        $path = "{$this->uri}/{$id}/following/{$target_user_id}";
        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
