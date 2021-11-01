<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Tweets\TweetLookup;
use Coderjerk\ElephantBird\Tweets\Timeline;
use Coderjerk\ElephantBird\Tweets\TweetCounts;
use Coderjerk\ElephantBird\Tweets\Search;
use Coderjerk\ElephantBird\Tweets\Reply;
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

    public function lookup($params = [])
    {
        return new TweetLookup($this->credentials, $params);
    }

    public function counts($params = [])
    {
        return new TweetCounts($this->credentials, $params);
    }

    public function search($params = [])
    {
        return new Search($this->credentials, $params);
    }

    public function timeline($params = [])
    {
        return new Timeline($this->credentials, $params);
    }

    /**
     * Hide or unhide a reply belonging to a conversation
     * initiated by the authenticating user.
     *
     * @param string $id Unique identifier of the Tweet to hide or unhide.
     * @return object|exception
     */
    public function reply()
    {
        return new Reply($this->credentials);
    }
}
