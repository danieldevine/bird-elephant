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
    public string $uri = 'tweets/sample/stream';

    private array $credentials;


    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Connects to filtered stream
     *
     * @param array|null $params
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function connectToStream(array $params = null): object
    {
        $request = new Request($this->credentials);
        return $request->authorisedRequest('GET', $this->uri, $params, null, true);
    }
}
