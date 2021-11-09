<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Returns Tweets from the last seven days
 * that match a search query.
 */
class Search extends ApiBase
{
    protected array $credentials;

    protected string $endpoint = 'tweets/search/';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Get Tweets that match a query in the last 7 days.
     *
     * @param $params
     * @return object
     * @throws GuzzleException
     */
    public function recent($params): object
    {
        return $this->find('recent', $params);
    }

    /**
     * Get Tweets that match a query.
     * Only available via the Academic Research product track!!
     *
     * @param $params
     * @return object
     * @throws GuzzleException
     */
    public function all($params): object
    {
        return $this->find('all', $params);
    }

    /**
     * @param string $path
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    protected function find(string $path, array $params): object
    {
        $path = $this->endpoint . $path;
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
