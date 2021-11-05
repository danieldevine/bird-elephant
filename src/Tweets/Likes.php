<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;

/**
 * Lookup and manage likes
 */
class Likes extends ApiBase
{
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Allows you to get information about a Tweet’s liking users.
     * You will receive the most recent 100 users who liked the specified Tweet.
     *
     * @param string $id - the tweet id
     * @param array $params
     * @return object|exception
     */
    public function likingUsers($tweet_id, $params)
    {
        $path = "tweets/{$tweet_id}/liking_users";
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
