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
     * The endpoint base
     *
     * @var string
     */
    public $endpoint_base = 'tweets';

    /**
     * Tokens and secrets
     *
     * @var array
     */
    protected array $credentials;

    /**
     * Query parameters
     *
     * @var array
     */
    protected array $params;

    public function __construct(array $credentials, array $params)
    {
        $this->credentials = $credentials;
        $this->params = $params;
    }

    /**
     * Get a single tweet
     *
     * @param string $id
     * @return object|exception
     */
    public function getTweet(string $id)
    {
        $path = $this->endpoint_base . '/' . $id;

        return $this->get($this->credentials, $path, $this->params);
    }

    /**
     * Get multiple tweets
     *
     * @param array $ids
     * @return object|exception
     */
    public function getTweets(array $ids)
    {
        if (count($ids) === 1) {
            $this->getTweet($ids[0]);
        }

        $path = $this->endpoint_base;
        $this->params['ids'] = join(',', $ids);

        return $this->get($this->credentials, $path, $this->params);
    }
}
