<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;

/**
 * Hides or unhides a reply to a Tweet.
 */
class Reply extends ApiBase
{
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Hide a reply
     *
     * @param string $id
     * @return object|exception
     */
    public function hide($id)
    {
        return $this->manageReplies($id, ["hidden" => true]);
    }

    /**
     * Unhide a reply
     *
     * @param string $id
     * @return object|exception
     */
    public function unhide($id)
    {
        return $this->manageReplies($id, ["hidden" => false]);
    }

    protected function manageReplies($id, $data)
    {
        $endpoint = "tweets/{$id}/hidden";
        return $this->put($this->credentials, $endpoint, null, $data, false, true);
    }
}
