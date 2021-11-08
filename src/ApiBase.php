<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Request;
use Coderjerk\BirdElephant\Users\UserLookup;
use GuzzleHttp\Exception\GuzzleException;

class ApiBase
{
    /**
     * @param array $credentials
     * @param string $http_method
     * @param mixed $options
     * @return object
     * @throws GuzzleException
     */
    private function go(array $credentials, string $http_method, $options): object
    {
        $request = new Request($credentials);
        return $request->authorisedRequest($http_method, ...$options);
    }

    /**
     * @param array $credentials
     * @param  ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function get(array $credentials, ...$options): object
    {
        return $this->go($credentials, 'GET', $options);
    }

    /**
     * @param $credentials
     * @param ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function post($credentials, ...$options): object
    {
        return $this->go($credentials, 'POST', $options);
    }

    /**
     * @param $credentials
     * @param ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function put($credentials, ...$options): object
    {
        return $this->go($credentials, 'PUT', $options);
    }

    /**
     * @param $credentials
     * @param ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function delete($credentials, ...$options): object
    {
        return $this->go($credentials, 'DELETE', $options);
    }

    /**
     * @param $username
     * @return string
     */
    protected function getUserId($username): string
    {
        $user = new UserLookup($this->credentials);
        return $user->getUserIdFromUsername($username);
    }
}
