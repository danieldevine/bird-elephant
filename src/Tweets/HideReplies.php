<?php

namespace Coderjerk\ElephantBird\Tweets;

use Coderjerk\ElephantBird\ApiBase;

class HideReplies extends ApiBase
{
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }
}
