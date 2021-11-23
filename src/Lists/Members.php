<?php

namespace Coderjerk\BirdElephant\Lists;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Members extends ApiBase
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
        $path = "lists/{$list_id}/members";
        return $this->get($this->credentials, $path, $params, null, false, false);
    }

    /**
     * Add a named user to a list owned by the authenticated user
     *
     * @param string $list_id
     * @param string $member
     * @return object
     * @throws GuzzleException
     */
    public function add(string $list_id, string $member): object
    {
        $member_id = $this->getUserId($member);

        $path = "lists/{$list_id}/members";
        $data = [
            'user_id' => $member_id
        ];

        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * Remove a named user from a list owned by the authenticated user
     *
     * @param string $list_id
     * @param string $member
     * @return object
     * @throws GuzzleException
     */
    public function remove(string $list_id, string $member): object
    {
        $member_id = $this->getUserId($member);

        $path = "lists/{$list_id}/members/{$member_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
