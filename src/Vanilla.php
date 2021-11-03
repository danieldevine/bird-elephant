<?php

namespace Coderjerk\ElephantBird\Vanilla;

class Vanilla
{

    /**
     * Access any endpoint
     *
     * Raw access for those who prefer to control all the
     * variables in exchange for a lack of convenience.
     *
     * @param array $credentials - array of credentials
     * @param string $http_method - 'GET'|'POST|'PUT'|'DELETE'
     * @param string $endpoint - the endpoint you want to call
     * @param array $params - query parameters
     * @param array|null $data - post/put data
     * @param boolean $stream - streaming endpoint if true, default false
     * @param boolean $signed - bearer auth or user context auth, default bearer
     * @return object|exception
     */
    public function call(array $credentials, string $http_method, string $endpoint, array $params, array $data = null, bool $stream = false, bool $signed = false)
    {
        $request = new Request($credentials);
        return $request->authorisedRequest($this->credentials, $http_method, $endpoint, $params, $data, $stream, $signed);
    }
}
