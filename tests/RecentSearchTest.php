<?php

namespace Coderjerk\ElephantBird\Tests;

use PHPUnit\Framework\TestCase;
use Coderjerk\ElephantBird\Tweets\RecentSearch;

use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertIsObject;
use function PHPUnit\Framework\assertObjectHasAttribute;

class RecentSearchTest extends TestCase
{
    public function testRecentSearchRequest()
    {
        $credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );

        $params = [
            'query'        => 'football',
            'tweet.fields' => 'author_id,created_at,source',
        ];

        $search = new RecentSearch($credentials);
        $result = $search->RecentSearchRequest($params);

        $tweets = $result->data;
        $test_case = $tweets[0];

        assertIsArray($result->data);

        assertIsObject($test_case);

        assertObjectHasAttribute('author_id', $test_case);
    }
}
