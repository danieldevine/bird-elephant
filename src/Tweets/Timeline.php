<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Access Tweets published by a
 * specific Twitter account.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class Timeline extends ApiBase
{
    /**
     * The endpoint
     *
     * @var string
     */
    public string $uri = 'users';

    /**
     * @var array
     */
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Gets a given user's tweets
     *
     * @param string $user
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getTweets(string $user, array $params): object
    {
        return $this->getTimeline($user, '/tweets', $params);
    }

    /**
     * Gets a given user's mentions
     *
     * @param string $user
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getMentions(string $user, array $params): object
    {
        return $this->getTimeline($user, '/mentions', $params);
    }

    /**
     * Gets a given user's timeline
     * in reverse order
     *
     * @param string $user
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getReverseChronological(string $user, array $params): object
    {
        $id = $this->getUserId($user);
        $path = $this->uri . '/' .  $id . '/timelines/reverse_chronological';
        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * Gets timeline data
     *
     * @param string $user
     * @param string $endpoint
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    protected function getTimeline(string $user, string $endpoint, array $params): object
    {
        $id = $this->getUserId($user);
        $path = $this->uri . '/' .  $id . $endpoint;
        return $this->get($this->credentials, $path, $params);
    }
}
