<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;
use Coderjerk\BirdElephant\Request;

/**
 * Returns information about a user or group of users,
 * specified by a user ID or a username
 */
class UserLookup extends ApiBase
{
    protected $uri = 'users';

    protected $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Retrieves a single Twitter user
     *
     * @param string $id
     * @param array $params
     * @return object
     */
    public function getSingleUserById($id, $params)
    {
        $path = $this->uri . '/' . $id;
        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Retrieves multiple Twitter users
     *
     * @param array $ids
     * @param array $params
     * @return object
     */
    public function getMultipleUsersById($ids, $params)
    {
        if (count($ids) === 1) {
            $this->getSingleUserById($ids[0], $params);
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
    public function getSingleUserByUsername($username, $params)
    {
        $path = $this->uri . '/by/username/' . $username;

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
        $user = $this->getSingleUserByUsername($username, null);

        return $user->data->id;
    }

    /**
     * Retrieves multiple Twitter users by username
     *
     * @param array $usernames
     * @param array $params
     * @return object
     */
    public function getMultipleUsersByUsername($usernames, $params)
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
            return $this->getSingleUserByUsername($usernames[0], $params);
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
            return $this->getSingleUserById($ids[0], $params);
        } else {
            return $this->getMultipleUsersById($ids, $params);
        }
    }
}
