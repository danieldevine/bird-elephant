<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;

/**
 * Returns Tweets from the last seven days
 * that match a search query.
 *
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class Search extends ApiBase
{
    protected array $credentials;

    protected $endpoint = 'tweets/search/';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Get Tweets that match a query in the last 7 days.
     *
     * @return object|exception
     */
    public function recent($params)
    {
        return $this->find('recent', $params);
    }

    /**
     * Get Tweets that match a query.
     * Only available via the Academic Research product track!!
     *
     * @return object|exception
     */
    public function all($params)
    {
        return $this->find('all', $params);
    }

    protected function find($path, $params)
    {
        $path = $this->endpoint . $path;
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
