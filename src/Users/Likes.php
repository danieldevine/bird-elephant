<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;

class Likes extends ApiBase
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

    public function lookup($params)
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/liked_tweets";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    public function like($target_tweet_id)
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/likes";
        $data = [
            'tweet_id' => $target_tweet_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    public function unlike($target_tweet_id)
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/likes/{$target_tweet_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
