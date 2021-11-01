<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Tweets\TweetLookup;
use Coderjerk\ElephantBird\Tweets\Timeline;
use Coderjerk\ElephantBird\Tweets\FilteredStream;
use Coderjerk\ElephantBird\Tweets\SearchTweets;

use Coderjerk\ElephantBird\Tweets\TweetCounts;
use Coderjerk\ElephantBird\ApiBase;

class Tweets extends ApiBase
{
    /**
     * Twitter credentials.
     *
     * @var array
     */
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function timeline()
    {
    }

    public function counts($params = [])
    {
        return new TweetCounts($this->credentials, $params);
    }
}
