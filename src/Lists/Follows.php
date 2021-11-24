<?php

namespace Coderjerk\BirdElephant\Lists;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Follows extends ApiBase
{
    protected array $credentials;

    protected string $path;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Gets the members of a given list
     *
     * @param string $list_id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function lookup(string $list_id, array $params = []): object
    {
        $path = "lists/{$list_id}/followers";
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
