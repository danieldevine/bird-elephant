<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;

/**
 * Lookup and manage retweets
 */
class Retweets extends ApiBase
{
    protected array $credentials;

    /**
     * @var array
     */
    private array $params;

    public function __construct($credentials, $params)
    {
        $this->credentials = $credentials;
        $this->params = $params;
    }

    /**
     * Allows you to get information about a Tweet’s retweeters.
     * You will receive the most recent 100 users who retweeted the specified Tweet.
     *
     * @param string $id - the tweet id
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retweetedBy(string $id): object
    {
        $path = "tweets/{$id}/retweeted_by";
        return $this->get($this->credentials, $path, $this->params, null, false, false);
    }
}
