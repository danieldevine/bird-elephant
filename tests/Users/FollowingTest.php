<?php

namespace Coderjerk\BirdElephant\Tests\Users;

use Coderjerk\BirdElephant\BirdElephant;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsArray;

class FollowingTest extends TestCase
{

    public function testLookupFollowingByUser()
    {
        $credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );

        $username = 'coderjerk';

        $twitter = new BirdElephant($credentials);

        $following = $twitter->user($username)->following();

        assertIsArray($following->data);
    }
}
