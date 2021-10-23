<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\User;
use Coderjerk\ElephantBird\Tweets;
use Coderjerk\ElephantBird\Compliance;
use Coderjerk\ElephantBird\Lists;
use Coderjerk\ElephantBird\Spaces;

/**
 * Undocumented class
 */
class ElephantBird
{
    public function user($handle)
    {
        return new User($handle);
    }

    public function tweets($args)
    {
        return new Tweets($args);
    }
}
