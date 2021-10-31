<?php

namespace Coderjerk\ElephantBird\Users;

use Coderjerk\ElephantBird\ApiBase;

class Mutes extends ApiBase
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
     * Lookup muteed users for an
     * authenticated user account.
     *
     * @param array $params
     * @return object|exception
     */
    public function lookup($params)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/muting";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * mutes a named user
     *
     * @param string $target_username
     * @return void
     */
    public function mute($target_username)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $path = "users/{$id}/muting";
        $target_user_id = $this->getUserId($target_username, $this->credentials);
        $data = [
            'target_user_id' => $target_user_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * Unmutes a named user
     *
     * @param string $target_username
     * @return object|exception
     */
    public function unmute($target_username)
    {
        $id = $this->getUserId($this->username, $this->credentials);
        $target_user_id = $this->getUserId($target_username, $this->credentials);
        $path = "users/{$id}/muting/{$target_user_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
