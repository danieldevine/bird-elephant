<?php

namespace Coderjerk\ElephantBird\Tweets;

use Coderjerk\ElephantBird\ApiBase;

/**
 * Lookup and manage likes
 */
class Likes extends ApiBase
{
    protected array $credentials;

    public function __construct($credentials, $params)
    {
        $this->credentials = $credentials;
        $this->params = $params;
    }

    /**
     * Allows you to get information about a Tweet’s liking users.
     * You will receive the most recent 100 users who liked the specified Tweet.
     *
     * @param string $id - the tweet id
     * @return void
     */
    public function likingUsers($id)
    {
        $path = "tweets/{$id}/liking_users";
        return $this->get($this->credentials, $path, $this->params, null, false, false);
    }
}
