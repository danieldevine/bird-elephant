<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\User;

class ElephantBird
{
    public function user($id)
    {
        return new User($id);
    }
}
