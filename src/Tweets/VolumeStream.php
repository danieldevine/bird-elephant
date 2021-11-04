<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\Request;

class VolumeStream
{
    /**
     * endpoint
     *
     * @var string
     */
    public $uri = 'tweets/sample/stream';


    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Connects to filtered stream
     *
     * @param array $params
     * @return object
     */
    public function connectToStream($params = null)
    {
        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('GET', $this->uri, $params, null, true);
    }
}
