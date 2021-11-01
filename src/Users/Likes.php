<?php

namespace Coderjerk\ElephantBird\Users;

use Coderjerk\ElephantBird\ApiBase;

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

    /**
     * Lookup muteed users for an
     * authenticated user account.
     *
     * @param array $params
     * @return object|exception
     */
    public function lookup($params)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/liked_tweets";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * mutes a named user
     *
     * @param string $target_username
     * @return void
     */
    public function like($target_tweet_id)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/likes";
        $data = [
            'tweet_id' => $target_tweet_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * Unmutes a named user
     *
     * @param string $target_username
     * @return object|exception
     */
    public function unlike($target_tweet_id)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/likes/{$target_tweet_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
