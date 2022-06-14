<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Tweets\TweetLookup;
use Coderjerk\BirdElephant\Tweets\TweetCounts;
use Coderjerk\BirdElephant\Tweets\Search;
use Coderjerk\BirdElephant\Tweets\Reply;
use Coderjerk\BirdElephant\Tweets\Likes;
use Coderjerk\BirdElephant\Tweets\Retweets;
use Coderjerk\BirdElephant\Tweets\ManageTweets;
use GuzzleHttp\Exception\GuzzleException;

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
        $this->retweets = new Retweets($this->credentials);
        $this->manageTweets = new ManageTweets($this->credentials);
    }

    /**
     * Get a single tweet
     *
     * @param string $id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function get(string $id, array $params = []): object
    {
        return $this->lookup->getTweet($id, $params);
    }

    /**
     * Get multiple Tweets
     *
     * @param array $ids
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function lookup(array $ids, array $params = []): object
    {
        return $this->lookup->getTweets($ids, $params);
    }

    /**
     * Get tweet counts
     *
     * @return TweetCounts
     */
    public function count(): TweetCounts
    {
        return new TweetCounts($this->credentials);
    }

    /**
     * Search tweets
     *
     * @return Search
     */
    public function search(): Search
    {
        return new Search($this->credentials);
    }

    /**
     * Hide or unhide a reply belonging to a conversation
     * initiated by the authenticating user.
     *
     * @return Reply
     */
    public function reply(): Reply
    {
        return new Reply($this->credentials);
    }

    /**
     * Get users who've liked a given tweet
     *
     * @param string $id - tweet id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function likers(string $id, array $params = []): object
    {
        return $this->likes->likingUsers($id, $params);
    }


    /**
     * Get users who've retweeted a given tweet
     *
     * @param string $id - tweet id
     * @return object
     * @throws GuzzleException
     */
    public function retweeters(string $id, array $params = []): object
    {
        return $this->retweets->retweetedBy($id, $params);
    }


    /**
     * Send a tweet
     *
     * @param object $tweet
     * @return object
     */
    public function tweet(object $tweet): object
    {
        return $this->manageTweets->send($tweet);
    }

    /**
     * @param string $tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function delete(string $tweet_id): object
    {
        return $this->manageTweets->unsend($tweet_id);
    }

    /**
     * @param $file
     * @return object
     * @throws GuzzleException
     */
    public function upload($file): object
    {
        return $this->manageTweets->mediaUpload($file);
    }
}
