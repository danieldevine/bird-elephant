<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;

/**
 * Lookup and manage retweets
 */
class Retweets extends ApiBase
{
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Allows you to get information about a Tweet’s retweeters.
     * You will receive the most recent 100 users who retweeted the specified Tweet.
     *
     * @param string $id - the tweet id
     * @param array $params
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retweetedBy(string $tweet_id, array $params): object
    {
        $path = "tweets/{$tweet_id}/retweeted_by";
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
