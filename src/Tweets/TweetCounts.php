<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;

/**
 * Programmatically retrieve the numerical
 * count of Tweets for a query
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class TweetCounts extends ApiBase
{
    protected array $credentials;

    protected $endpoint = 'tweets/counts/';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Receive a count of Tweets that match a query in the last 7 days.
     *
     * @return object|exception
     */
    public function recent($params)
    {
        return $this->getCount('recent', $params);
    }

    /**
     * Receive a count of Tweets that match a query.
     * Only available via the Academic Research product track!!
     *
     * @todo I'm not on the academic track so haven't tested this - it works in theory :)
     * @return object|exception
     */
    public function all($params)
    {
        return $this->getCount('all', $params);
    }

    protected function getCount($path, $params)
    {
        $path = $this->endpoint . $path;
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
