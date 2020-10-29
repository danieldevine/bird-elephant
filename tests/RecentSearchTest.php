<?php

namespace Coderjerk\ElephantBird\Tests;

use PHPUnit\Framework\TestCase;
use Coderjerk\ElephantBird\RecentSearch;

use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertIsObject;
use function PHPUnit\Framework\assertObjectHasAttribute;

class RecentSearchTest extends TestCase
{
    public function testRecentSearchRequest()
    {
        $params = [
            'query'        => 'football',
            'tweet.fields' => 'author_id,created_at,source',
        ];

        $search = new RecentSearch;
        $result = $search->RecentSearchRequest($params);

        $tweets = $result->data;
        $test_case = $tweets[0];

        assertIsArray($result->data);

        assertIsObject($test_case);

        assertObjectHasAttribute('author_id', $test_case);
    }
}