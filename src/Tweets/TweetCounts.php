<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Programmatically retrieve the numerical
 * count of Tweets for a query
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class TweetCounts extends ApiBase
{
    protected array $credentials;

    protected string $endpoint = 'tweets/counts/';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Receive a count of Tweets that match a query in the last 7 days.
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function recent(array $params): object
    {
        return $this->getCount('recent', $params);
    }

    /**
     * Receive a count of Tweets that match a query.
     * Only available via the Academic Research product track!!
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     * @todo I'm not on the academic track so haven't tested this - it works in theory :)
     */
    public function all(array $params): object
    {
        return $this->getCount('all', $params);
    }

    /**
     * @param string $path
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    protected function getCount(string $path, array $params): object
    {
        $path = $this->endpoint . $path;
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
