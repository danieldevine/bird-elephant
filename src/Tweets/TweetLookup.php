<?php

namespace Coderjerk\ElephantBird\Tweets;

use Coderjerk\ElephantBird\ApiBase;

/**
 * Returns information about a Tweet or group
 * of Tweets, specified by a Tweet ID.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class TweetLookup extends ApiBase
{
    /**
     * The endpoint
     *
     * @var string
     */
    public $uri = 'tweets';

    public function __construct($credentials, $params)
    {
        $this->credentials = $credentials;
        $this->params = $params;
    }

    /**
     * Gets a single tweet.
     *
     * @param string $id
     * @return object|exception
     */
    public function getTweet($id)
    {
        $path = $this->uri . '/' . $id;

        return $this->get($this->credentials, $path, $this->params);
    }

    /**
     * Gets multiple tweets.
     *
     * @param array $ids
     * @return object|exception
     */
    public function getTweets($ids)
    {
        if (count($ids) === 1) {
            $this->getTweet($ids[0]);
        }

        $path = $this->uri;
        $this->params['ids'] = join(',', $ids);

        return $this->get($this->credentials, $path, $this->params);
    }
}
