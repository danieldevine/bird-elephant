<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Returns information about a Tweet or group
 * of Tweets, specified by a Tweet ID.
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
     * @param array $id
     * @param array $params
     * @return object
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
     * @param array $ids
     * @param array $params
     * @return object
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
