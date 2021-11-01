<?php

namespace Coderjerk\ElephantBird\Tweets;

use Coderjerk\ElephantBird\ApiBase;

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

    public function __construct($credentials, $params)
    {
        $this->credentials = $credentials;
        $this->params = $params;
    }

    /**
     * Get Tweets that match a query in the last 7 days.
     *
     * @return object|exception
     */
    public function recent()
    {
        return $this->find('recent');
    }

    /**
     * Get Tweets that match a query.
     * Only available via the Academic Research product track!!
     *
     * @return object|exception
     */
    public function all()
    {
        return $this->find('all');
    }

    protected function find($path)
    {
        $path = $this->endpoint . $path;
        return $this->get($this->credentials, $path, $this->params, null, false, false);
    }
}
