<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Request;
use Coderjerk\BirdElephant\Users\UserLookup;

class ApiBase
{
    private function go($credentials, $http_method, $options)
    {
        $request = new Request($credentials);
        return $request->authorisedRequest($http_method, ...$options);
    }

    protected function get($credentials, ...$options)
    {
        return $this->go($credentials, 'GET', $options);
    }

    protected function post($credentials, ...$options)
    {
        return $this->go($credentials, 'POST', $options);
    }

    protected function put($credentials, ...$options)
    {
        return $this->go($credentials, 'PUT', $options);
    }

    protected function delete($credentials, ...$options)
    {
        return $this->go($credentials, 'DELETE', $options);
    }

    protected function getUserId($username)
    {
        $user = new UserLookup($this->credentials);
        return $user->getUserIdFromUsername($username);
    }
}
