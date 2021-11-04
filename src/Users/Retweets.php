<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;

class Retweets extends ApiBase
{
    /**
     * Auth credentials
     *
     * @var array
     */
    protected array $credentials;

    /**
     * A Twitter handle
     *
     * @var string
     */
    protected string $username;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
    }


    public function retweet($target_tweet_id)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/retweets";
        $data = [
            'tweet_id' => $target_tweet_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }


    public function unretweet($target_tweet_id)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/retweets/{$target_tweet_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
