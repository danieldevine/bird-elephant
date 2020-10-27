<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Searches for public Tweets posted over the last week.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 */
class RecentSearch
{
    /**
     * The endpoint
     *
     * @var string
     */
    public $uri = 'tweets/search/recent';

    /**
     * A list of available params and their defaults is here:
     * https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent
     *
     * @var array
     */
    public $default_params = [
        'query' => 'cheese',
    ];

    /**
     * Makes the request.
     *
     * @param String $keyword
     * @return Object
     */
    public function RecentSearchRequest($params)
    {
        $params = $this->buildQuery($params);

        $request = new Request;
        return $request->makeRequest('GET', $this->uri, $params);
    }

    /**
     * Builds the query.
     *
     * @param String $keyword
     * @return Array
     */
    protected function buildQuery($params)
    {
        $params = array_merge($this->default_params, $params);

        return $params;
    }
}