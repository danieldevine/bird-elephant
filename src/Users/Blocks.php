<?php

namespace Coderjerk\ElephantBird\Users;

use Coderjerk\ElephantBird\ApiBase;

class Blocks extends ApiBase
{
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function lookup($username, $params)
    {
        $id = $this->getUserId($username, $this->credentials);
        $path = "users/{$id}/blocking";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    public function block($username, $target_username)
    {
        $id = $this->getUserId($username, $this->credentials);
        $path = "users/{$id}/blocking";
        $target_user_id = $this->getUserId($target_username, $this->credentials);
        $data = [
            'target_user_id' => $target_user_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    public function unblock($username, $target_username)
    {
        $id = $this->getUserId($username, $this->credentials);
        $target_user_id = $this->getUserId($target_username, $this->credentials);
        $path = "users/{$id}/blocking/{$target_user_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
