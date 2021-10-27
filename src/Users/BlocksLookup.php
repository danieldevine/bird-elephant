<?php

namespace Coderjerk\ElephantBird\Users;

use Coderjerk\ElephantBird\Request;

class BlocksLookup extends UserLookup
{
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function getBlocks($username, $params)
    {
        $id = $this->getUserIdFromUsername($username);
        $path = 'users' . '/' .  $id . '/blocking';
        $request = new Request($this->credentials);
        return $request->userContextRequest($this->credentials, 'GET', $path, $params);
    }
}
