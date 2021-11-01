<?php

namespace Coderjerk\ElephantBird\Tweets;

use Coderjerk\ElephantBird\ApiBase;

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

    public function __construct($credentials, $params)
    {
        $this->credentials = $credentials;
        $this->params = $params;
    }

    /**
     * Receive a count of Tweets that match a query in the last 7 days.
     *
     * @return object|exception
     */
    public function recent()
    {
        return $this->getCount('recent');
    }

    /**
     * Receive a count of Tweets that match a query.
     * Only available via the Academic Research product track!!
     *
     * @return object|exception
     */
    public function all()
    {
        return $this->getCount('all');
    }

    protected function getCount($path)
    {
        $path = $this->endpoint . $path;
        return $this->get($this->credentials, $path, $this->params, null, false, false);
    }
}
