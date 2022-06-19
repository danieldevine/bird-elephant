<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;
use Coderjerk\BirdElephant\Request;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Returns information about a user or group of users,
 * specified by a user ID or a username
 */
class UserLookup extends ApiBase
{
    protected string $uri = 'users';

    protected array $credentials;

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
     * @throws GuzzleException
     */
    public function getSingleUserById(string $id, array $params): object
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
     * @throws GuzzleException
     */
    public function getMultipleUsersById(array $ids, array $params): object
    {
        if (count($ids) === 1) {
            $this->getSingleUserById($ids[0], $params);
        }

        $path = $this->uri;
        $params['ids'] = join(',', $ids);

        $request = new Request($this->credentials);

        return $request->authorisedRequest('GET', $path, $params);
    }

    /**
     * Retrieves a single Twitter user by username
     *
     * @param string $username
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getSingleUserByUsername(string $username, array $params): object
    {
        $path = $this->uri . '/by/username/' . $username;

        $request = new Request($this->credentials);
        return $request->authorisedRequest('GET', $path, $params);
    }

    /**
     * Gets a user's id from their username
     *
     * @param string $username
     * @return string
     * @throws GuzzleException
     */
    public function getUserIdFromUsername(string $username): string
    {
        $user = $this->getSingleUserByUsername($username, $params = []);

        return $user->data->id;
    }

    /**
     * Retrieves multiple Twitter users by username
     *
     * @param array $usernames
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getMultipleUsersByUsername(array $usernames, array $params): object
    {
        $path = $this->uri . '/by';
        $params['usernames'] = join(',', $usernames);

        $request = new Request($this->credentials);

        return $request->authorisedRequest('GET', $path, $params);
    }

    /**
     * Looks up Twitter users by username
     *
     * @param array $usernames
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function lookupUsersByUsername(array $usernames, array $params): object
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
     * @throws GuzzleException
     */
    public function lookupUsersById(array $ids, array $params): object
    {
        if (count($ids) === 1) {
            return $this->getSingleUserById($ids[0], $params);
        } else {
            return $this->getMultipleUsersById($ids, $params);
        }
    }

    /**
     * Gets info about the authenticated user
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getMe(array $params): object
    {
        $path = $this->uri . '/me/';

        return $this->get($this->credentials, $path, $params, null, false, true);
    }
}
