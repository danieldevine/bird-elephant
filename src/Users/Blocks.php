<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Blocks extends ApiBase
{
    /**
     * Auth credentials
     *
     * @var array
     */
    protected array $credentials;

    /**
     * A Twitter handle
     *
     * @var string
     */
    protected string $username;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
    }

    /**
     * Lookup blocked users for an
     * authenticated user account.
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function lookup(array $params): object
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/blocking";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * Blocks a named user
     *
     * @param string $target_username
     * @return object
     * @throws GuzzleException
     */
    public function block(string $target_username): object
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/blocking";
        $target_user_id = $this->getUserId($target_username, $this->credentials);
        $data = [
            'target_user_id' => $target_user_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * Unblocks a named user
     *
     * @param string $target_username
     * @return object
     * @throws GuzzleException
     */
    public function unblock(string $target_username): object
    {
        $id = $this->getUserId($this->username);
        $target_user_id = $this->getUserId($target_username);
        $path = "users/{$id}/blocking/{$target_user_id}";
        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
