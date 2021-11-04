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

    public $default_params = [
        'max_results' => 10
    ];

    public function __construct($credentials, $params)
    {
        $this->credentials = $credentials;
        $this->params = $params;
    }

    /**
     * Gets a given user's tweets
     *
     * @param string $user
     * @return object
     */
    public function getTweets($user)
    {
        return $this->getTimeline($user, '/tweets');
    }

    /**
     * Gets a given user's mentions
     *
     * @param string $user
     * @return object
     */
    public function getMentions($user)
    {
        return $this->getTimeline($user, '/mentions');
    }

    /**
     * Gets timeline data
     *
     * @param string $user
     * @param array $endpoint
     * @return void
     */
    protected function getTimeline($user, $endpoint)
    {
        $id = $this->getUserId($user);
        $path = $this->uri . '/' .  $id . $endpoint;
        $params = array_merge($this->default_params, $this->params);
        return $this->get($this->credentials, $path, $params);
    }
}
