<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Save Tweets and easily access them later.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 * @since 0.4.8
 */
class Bookmarks extends ApiBase
{
    /**
     * Auth credentials
     *
     * @var array
     */
    protected array $credentials;

    /**
     * A Twitter handle
     *
     * @var string
     */
    protected string $username;

    /**
     * A Twitter user ID
     *
     * @var int
     */
    protected ?int $userid;

    /**
     * The endpoint uri
     *
     * @var string
     */
    protected string $uri;

    public function __construct($credentials, $username, ?int $userid = null)
    {
        $this->credentials = $credentials;
        $this->userid = $userid ?? $this->getUserId($username);

        $this->uri = 'users/' . $this->userid . '/bookmarks';
    }

    /**
     * Lookup bookmarks for the authenticated user
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function lookup(array $params): object
    {
        return $this->get($this->credentials, $this->uri, $params, null, false, true);
    }

    /**
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function bookmark(string $target_tweet_id): object
    {
        $data = [
            'tweet_id' => $target_tweet_id
        ];

        return $this->post($this->credentials, $this->uri, null, $data, false, true);
    }

    /**
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unbookmark(string $target_tweet_id): object
    {
        $path = $this->uri . '/' . $target_tweet_id;

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
