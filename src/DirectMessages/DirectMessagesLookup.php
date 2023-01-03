<?php

namespace Coderjerk\BirdElephant\DirectMessages;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class DirectMessagesLookup extends ApiBase
{
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Returns a list of Direct Messages for the authenticated
     * user, both sent and received. Direct Message events are
     * returned in reverse chronological order. Supports
     * retrieving events from the previous 30 days.
     *
     * https://developer.twitter.com/en/docs/twitter-api/direct-messages/lookup/api-reference/get-dm_events
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function events(array $params = []): object
    {
        $path = "dm_events";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * Retrieves conversations by correspondant user name
     *
     * https://developer.twitter.com/en/docs/twitter-api/direct-messages/lookup/api-reference/get-dm_conversations-dm_conversation_id-dm_events
     *
     * @param string $participant_name
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function with(string $participant_name, array $params = []): object
    {
        $participant_id = $this->getUserId($participant_name);

        $path = "dm_conversations/with/{$participant_id}/dm_events";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * Retrieves a DM Conversation by conversation id
     *
     * https://developer.twitter.com/en/docs/twitter-api/direct-messages/lookup/api-reference/get-dm_conversations-dm_conversation_id-dm_events
     *
     * @param string $conversation_id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function find(string $conversation_id, array $params = []): object
    {
        $path = "dm_conversations/{$conversation_id}/dm_events";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }
}
