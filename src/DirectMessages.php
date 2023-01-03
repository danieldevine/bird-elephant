<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\DirectMessages\DirectMessagesLookup;
use Coderjerk\BirdElephant\DirectMessages\ManageDirectMessages;
use Coderjerk\BirdElephant\Compose\DirectMessage;

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
    public function conversations(): DirectMessagesLookup
    {
        return new DirectMessagesLookup($this->credentials);
    }

    public function message(DirectMessage $direct_message): ManageDirectMessages
    {
        return new ManageDirectMessages($this->credentials, $direct_message);
    }

    /**
     * @param $file
     * @return object
     * @throws GuzzleException
     */
    public function upload($file): object
    {
        $request = new Request($this->credentials);
        return $request->uploadMedia($file);
    }
}
