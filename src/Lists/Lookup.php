<?php

namespace Coderjerk\BirdElephant\Lists;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Lookup extends ApiBase
{

    /**
     * The endpoint base
     *
     * @var string
     */
    protected string $endpoint_base = 'lists';

    /**
     * Tokens and secrets
     *
     * @var array
     */
    protected array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Returns a variety of information about a single Space
     * specified by the requested ID
     *
     * @param string $list_id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getList(string $list_id, array $params = []): object
    {
        $path = $this->endpoint_base . '/' . $list_id;
        return $this->get($this->credentials, $path, $params);
    }
}
