<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Tweets\TweetLookup;
use Coderjerk\BirdElephant\Tweets\TweetCounts;
use Coderjerk\BirdElephant\Tweets\Search;
use Coderjerk\BirdElephant\Tweets\Reply;
use Coderjerk\BirdElephant\Tweets\Likes;

class Tweets
{
    /**
     * Twitter credentials.
     *
     * @var array
     */
    protected array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
        $this->lookup = new TweetLookup($this->credentials);
        $this->likes = new Likes($this->credentials);
    }

    /**
     * Get a single tweet
     *
     * @param string $id
     * @param array $params
     * @return object|exception
     */
    public function get(string $id, array $params = [])
    {
        return $this->lookup->getTweet($id, $params);
    }

    /**
     * Get multiple Tweets
     *
     * @param array $ids
     * @param array $params
     * @return object|exception
     */
    public function lookup(array $ids, array $params = [])
    {
        return $this->lookup->getTweets($ids, $params);
    }

    /**
     * Get tweet counts
     *
     * @return object|exception
     */
    public function count()
    {
        return new TweetCounts($this->credentials);
    }

    /**
     * Search tweets
     *
     * @return object|exception
     */
    public function search()
    {
        return new Search($this->credentials);
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

    /**
     * Get users who've liked a given tweet
     *
     * @param string $id - tweet id
     * @param array $params
     * @return void
     */
    public function likers(string $id, array $params = [])
    {
        return $this->likes->likingUsers($id, $params);
    }
}
