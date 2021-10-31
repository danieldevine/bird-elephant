<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;
use Coderjerk\ElephantBird\Users\UserLookup;

class ApiBase
{
    private function go($credentials, $http_method, $path, $params, $data = null, $stream = false, $signed = false)
    {
        $request = new Request($credentials);

        if ($signed === false) {
            return $request->bearerTokenRequest($http_method, $path, $params, $data, $stream);
        } else {
            return $request->userContextRequest($http_method, $path, $params, $data, $stream);
        }
    }

    protected function get($credentials, $path, $params, $data = null, $stream = false, $signed = false)
    {
        return $this->go($credentials, 'GET', $path, $params, $data, $stream, $signed);
    }

    protected function post($credentials, $path, $params, $data = null, $stream = false, $signed = false)
    {
        return $this->go($credentials, 'POST', $path, $params, $data, $stream, $signed);
    }

    protected function put($credentials, $path, $params, $data = null, $stream = false, $signed = false)
    {
        return $this->go($credentials, 'PUT', $path, $params, $data, $stream, $signed);
    }

    protected function delete($credentials, $path, $params, $data = null, $stream = false, $signed = false)
    {
        return $this->go($credentials, 'DELETE', $path, $params, $data, $stream, $signed);
    }

    protected function getUserId($username)
    {
        $user = new UserLookup($this->credentials);
        return $user->getUserIdFromUsername($username);
    }
}
