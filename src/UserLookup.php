<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Undocumented class
 */
class UserLookup
{

    public $uri = 'users';

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

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }

    /**
     * REtrieves multiple Twitter users
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

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }


    protected function getSingleUserByUsername($usernames, $params)
    {
        $path = $this->uri . '/by/username/' . $usernames[0];

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }


    protected function getMultipleUsersByUsername($usernames, $params)
    {
        $path = $this->uri . '/by';
        $params['usernames'] = join(',', $usernames);

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }


    public function lookupUsersByUsername($usernames, $params)
    {
        if (count($usernames) === 1) {
            return $this->getSingleUserByUsername($usernames, $params);
        } else {
            return $this->getMultipleUsersByUsername($usernames, $params);
        }
    }

    public function lookupUsersById($ids, $params)
    {
        if (count($ids) === 1) {
            return $this->getSingleUserById($ids, $params);
        } else {
            return $this->getMultipleUsersById($ids, $params);
        }
    }
}
