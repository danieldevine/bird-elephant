<?php

namespace Coderjerk\ElephantBird\Tests;

use PHPUnit\Framework\TestCase;
use Coderjerk\ElephantBird\Tweets\TweetLookup;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertIsObject;

class TweetLookupTest extends TestCase
{
    public function testTweetLookupByIdMultiple()
    {
        $credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );

        $ids = [
            '1261326399320715264',
            '1278347468690915330'
        ];

        $params = [
            'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
        ];

        $lookup = new TweetLookup($credentials);
        $tweets = $lookup->getTweetsById($ids, $params);
        $test_case = $tweets->data[0];

        assertIsArray($tweets->data);

        assertIsObject($test_case);

        assertCount(2, $tweets->data);
    }

    public function testTweetLookupByIdSingle()
    {
        $credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );

        $params = [
            'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
        ];

        $ids = ['1261326399320715264'];

        $lookup = new TweetLookup($credentials);
        $tweets = $lookup->getTweetsById($ids, $params);

        $test_case = $tweets->data[0];

        assertIsArray($tweets->data);

        assertIsObject($test_case);

        assertCount(1, $tweets->data);
    }
}
