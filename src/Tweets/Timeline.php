<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;

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
    public $uri = 'users';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Gets a given user's tweets
     *
     * @param string $user
     * @param array $params
     * @return object|exception
     */
    public function getTweets($user, $params)
    {
        return $this->getTimeline($user, '/tweets', $params);
    }

    /**
     * Gets a given user's mentions
     *
     * @param string $user
     * @param array $params
     * @return object|exception
     */
    public function getMentions($user, $params)
    {
        return $this->getTimeline($user, '/mentions', $params);
    }

    /**
     * Gets timeline data
     *
     * @param string $user
     * @param array $endpoint
     * @return object|exception
     */
    protected function getTimeline($user, $endpoint, $params)
    {
        $id = $this->getUserId($user);
        $path = $this->uri . '/' .  $id . $endpoint;
        return $this->get($this->credentials, $path, $params);
    }
}
