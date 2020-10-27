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
     * Undocumented function
     *
     * @param [type] $ids
     * @param [type] $params
     * @return Object
     */
    protected function getSingleUserById($ids, $params)
    {
        $path = $this->uri . '/' . $ids[0];

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }

    /**
     * Undocumented function
     *
     * @param [type] $ids
     * @param [type] $params
     * @return Object
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

    /**
     * Undocumented function
     *
     * @param [type] $Usernames
     * @param [type] $params
     * @return Object
     */
    protected function getSingleUserByUsername($usernames, $params)
    {
        $path = $this->uri . '/by/username/' . $usernames[0];

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }

    /**
     * Undocumented function
     *
     * @param [type] $Usernames
     * @param [type] $params
     * @return Object
     */
    protected function getMultipleUsersByUsername($usernames, $params)
    {
        $path = $this->uri . '/by';
        $params['usernames'] = join(',', $usernames);

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }

    /**
     * Undocumented function
     *
     * @param [type] $usernames
     * @param [type] $params
     * @return Object
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
     * Undocumented function
     *
     * @param [type] $usernames
     * @param [type] $params
     * @return Object
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