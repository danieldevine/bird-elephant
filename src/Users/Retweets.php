<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Retweets extends ApiBase
{
    /**
     * Auth credentials
     *
     * @var array
     */
    protected array $credentials;

    /**
     * A Twitter username
     *
     * @var string
     */
    protected string $username;

    /**
     * A Twitter user ID
     *
     * @var int
     */
    protected ?int $userid;

    public function __construct($credentials, $username, ?int $userid = null)
    {
        $this->credentials = $credentials;
        $this->username = $username;
        $this->userid = $userid;
    }


    /**
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function retweet(string $target_tweet_id): object
    {
        $id = $this->userid ?? $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/retweets";
        $data = [
            'tweet_id' => $target_tweet_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }


    /**
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unretweet(string $target_tweet_id): object
    {
        $id = $this->userid ?? $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/retweets/{$target_tweet_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
