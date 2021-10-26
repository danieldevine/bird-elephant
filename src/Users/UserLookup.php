<?php

namespace Coderjerk\ElephantBird\Users;

use Coderjerk\ElephantBird\Request;

/**
 * Undocumented class
 */
class UserLookup
{

    public $uri = 'users';

    public $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Retrieves a single Twitter user
     *
     * @param array $ids
     * @param array $params
     * @return object
     */
    protected function getSingleUserById($ids, $params)
    {
        $path = $this->uri . '/' . $ids[0];

        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('GET', $path, $params);
    }

    /**
     * Retrieves multiple Twitter users
     *
     * @param array $ids
     * @param array $params
     * @return object
     */
    protected function getMultipleUsersById($ids, $params)
    {
        if (count($ids) === 1) {
            $this->getSingleUserById($ids, $params);
        }

        $path = $this->uri;
        $params['ids'] = join(',', $ids);

        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('GET', $path, $params);
    }

    /**
     * Retrieves a single Twitter user by username
     *
     * @param array $usernames
     * @param array $params
     * @return object
     */
    protected function getSingleUserByUsername($usernames, $params)
    {
        $path = $this->uri . '/by/username/' . $usernames[0];

        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('GET', $path, $params);
    }

    /**
     * Gets a user's id from their handle
     *
     * @param string $username
     * @return string
     */
    public function getUserIdFromUsername($username)
    {
        $user =  $this->getSingleUserByUsername([$username], null);

        return $user->data->id;
    }

    /**
     * Retrieves multiple Twitter users by username
     *
     * @param array $usernames
     * @param array $params
     * @return void
     */
    protected function getMultipleUsersByUsername($usernames, $params)
    {
        $path = $this->uri . '/by';
        $params['usernames'] = join(',', $usernames);

        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('GET', $path, $params);
    }

    /**
     * Looks up Twitter users by username
     *
     * @param array $usernames
     * @param array $params
     * @return object
     */
    public function lookupUsersByUsername($usernames, $params)
    {
        if (count($usernames) === 1) {
            return $this->getSingleUserByUsername($usernames, $params);
        } else {
            return $this->getMultipleUsersByUsername($usernames, $params);
        }
    }

    /**
     * Looks up Twitter users by Id
     *
     * @param array $ids
     * @param array $params
     * @return object
     */
    public function lookupUsersById($ids, $params)
    {
        if (count($ids) === 1) {
            return $this->getSingleUserById($ids, $params);
        } else {
            return $this->getMultipleUsersById($ids, $params);
        }
    }
}
