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
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function hide(string $id): object
    {
        return $this->manageReplies($id, ["hidden" => true]);
    }

    /**
     * Unhide a reply
     *
     * @param string $id
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unhide(string $id): object
    {
        return $this->manageReplies($id, ["hidden" => false]);
    }

    /**
     * @param $id string
     * @param $data array
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function manageReplies(string $id, array $data): object
    {
        $endpoint = "tweets/{$id}/hidden";
        return $this->put($this->credentials, $endpoint, null, $data, false, true);
    }
}
