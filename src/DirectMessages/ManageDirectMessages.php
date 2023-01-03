<?php

namespace Coderjerk\BirdElephant\DirectMessages;

use Coderjerk\BirdElephant\ApiBase;
use Coderjerk\BirdElephant\Compose\DirectMessage;

class ManageDirectMessages extends ApiBase
{

    /**
     * Twitter Credentials
     *
     * @var array
     */
    protected array $credentials;


    public DirectMessage $direct_message;


    public function __construct($credentials, $direct_message)
    {
        $this->credentials = $credentials;
        $this->direct_message = $direct_message;
    }

    /**
     * Create a message in a 1-1 conversation with the participant
     *
     * @param object $direct_message
     * @return object
     * @throws GuzzleException
     */
    public function sendTo(string $participant_name): object
    {
        $participant_id = $this->getUserId($participant_name);

        $path = "dm_conversations/with/{$participant_id}/messages";

        $direct_message = $this->direct_message->build();

        return $this->post($this->credentials, $path, null, $direct_message, false, true);
    }

    /**
     * Create a group conversation and add a DM to it
     *
     * @param object $direct_message
     * @return object
     * @throws GuzzleException
     */
    public function newConversation()
    {
        $path = "dm_conversations";

        $direct_message = $this->direct_message->build();

        return $this->post($this->credentials, $path, null, $direct_message, false, true);
    }

    /**
     * Adds a DM to an existing conversation (for both group and 1-1)
     *
     * @param string $conversation_id
     * @param object $direct_message
     * @return object
     * @throws GuzzleException
     */
    public function addToConversation(string $conversation_id)
    {
        $path = "dm_conversations/{$conversation_id}/messages";

        $direct_message = $this->direct_message->build();

        return $this->post($this->credentials, $path, null, $direct_message, false, true);
    }


    /**
     * upload via API v1.1 because
     * media upload not yet available on v2
     *
     * @param string $file
     * @return object
     * @throws GuzzleException
     */
    public function mediaUpload(string $file): object
    {
        $request = new Request($this->credentials);
        return $request->uploadMedia($file);
    }
}
