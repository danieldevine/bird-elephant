<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Returns information about a Tweet or group
 * of Tweets, specified by a Tweet ID.
 *
 * There are two endpoints available for tweet lookups - single and multiple:
 * https://developer.twitter.com/en/docs/twitter-api/tweets/lookup/introduction
 *
 * @author Dan Devine <jerk@coderjerk.com>
 */
class TweetLookup
{
    /**
     * The endpoint
     *
     * @var string
     */
    public $uri = 'tweets';

    /**
     * Gets a single tweet.
     * Uses the first id in the array.
     *
     * @param Array $id
     * @param Array $params
     * @return Object
     */
    public function getSingleTweetById($ids, $params)
    {
        $path = $this->uri . '/' . $ids[0];

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }

    /**
     * Gets multiple tweets.
     *
     * @param Array $ids
     * @param Array $params
     * @return Object
     */
    public function getTweetsById($ids, $params)
    {
        if (count($ids) === 1) {
            $this->getSingleTweetById($ids, $params);
        }

        $path = $this->uri;
        $params['ids'] = join(',', $ids);

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }
}