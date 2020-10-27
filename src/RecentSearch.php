<?php

namespace Coderjerk\TwitterSearch;

use Coderjerk\TwitterSearch\Request;

/**
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
     * A default set of params for the query.
     * A list of available params and their defaults is here:
     * https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent
     *
     * @var array
     */
    public $default_query = [
        'query' => 'cheese',
    ];

    /**
     * Undocumented function
     *
     * @param String $keyword
     * @return Object
     */
    public function RecentSearchRequest($query)
    {
        $query = $this->buildQuery($query);

        $request = new Request;
        return $request->makeRequest('GET', $this->uri, $query);
    }

    /**
     * Undocumented function
     *
     * @param String $keyword
     * @return Array
     */
    protected function buildQuery($query)
    {
        $query = array_merge($this->default_query, $query);

        return $query;
    }
}