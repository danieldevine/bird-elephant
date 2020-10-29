<?php

namespace Coderjerk\ElephantBird\Tests;

use PHPUnit\Framework\TestCase;
use Coderjerk\ElephantBird\UserLookup;

use function PHPUnit\Framework\assertEquals;

class UserLookupTest extends TestCase
{
    public function testLookUpUsersByUsername()
    {
        $usernames = [
            'coderjerk'
        ];

        $params = [
            'user.fields' => 'id'
        ];

        $userLookup = new UserLookup;

        $user = $userLookup->lookupUsersByUsername($usernames, $params);

        assertEquals($user->data->id, '802448659');
    }

    public function testLookUpUsersById()
    {
        $ids = [
            '802448659',
            '16298441'
        ];

        $params = [
            'user.fields' => 'id'
        ];

        $userLookup = new UserLookup;

        $user = $userLookup->lookupUsersById($ids, $params);

        assertEquals(count($user->data), 2);
    }
}