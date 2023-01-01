<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\DirectMessages\DirectMessagesLookup;

class DirectMessages
{
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**z
     * Direct Message Lookup
     *
     * @return DirectMessagesLookup
     */
    public function lookup(): DirectMessagesLookup
    {
        return new DirectMessagesLookup($this->credentials);
    }
}
