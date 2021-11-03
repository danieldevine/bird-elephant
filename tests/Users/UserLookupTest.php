<?php

namespace Coderjerk\ElephantBird\Tests\Users;

use Coderjerk\ElephantBird\Users\UserLookup;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class UserLookupTest extends TestCase
{
    public function testLookUpUsersByUsername()
    {
        $credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );

        $usernames = [
            'coderjerk'
        ];

        $params = [
            'user.fields' => 'id'
        ];

        $userLookup = new UserLookup($credentials);

        $user = $userLookup->lookupUsersByUsername($usernames, $params);

        assertEquals($user->data->id, '802448659');
    }

    public function testLookUpUsersById()
    {
        $credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );

        $ids = [
            '802448659',
            '16298441'
        ];

        $params = [
            'user.fields' => 'id'
        ];

        $userLookup = new UserLookup($credentials);

        $user = $userLookup->lookupUsersById($ids, $params);

        assertEquals(count($user->data), 2);
    }
}
