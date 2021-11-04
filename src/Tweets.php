<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Tweets\TweetLookup;
use Coderjerk\BirdElephant\Tweets\Timeline;
use Coderjerk\BirdElephant\Tweets\TweetCounts;
use Coderjerk\BirdElephant\Tweets\Search;
use Coderjerk\BirdElephant\Tweets\Reply;
use Coderjerk\BirdElephant\Tweets\Likes;
use Coderjerk\BirdElephant\Tweets\Retweets;

class Tweets
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

    public function lookup(array $params = [])
    {
        return new TweetLookup($this->credentials, $params);
    }

    public function counts(array $params = [])
    {
        return new TweetCounts($this->credentials, $params);
    }

    public function search(array $params = [])
    {
        return new Search($this->credentials, $params);
    }

    public function timeline(array $params = [])
    {
        return new Timeline($this->credentials, $params);
    }

    /**
     * Hide or unhide a reply belonging to a conversation
     * initiated by the authenticating user.
     *
     * @param string $id - Unique identifier of the Tweet to hide or unhide.
     * @return object|exception
     */
    public function reply()
    {
        return new Reply($this->credentials);
    }

    public function likes(array $params)
    {
        return new Likes($this->credentials, $params);
    }

    public function retweets(array $params)
    {
        return new Retweets($this->credentials, $params);
    }
}
