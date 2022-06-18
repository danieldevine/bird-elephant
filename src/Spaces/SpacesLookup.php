<?php

namespace Coderjerk\BirdElephant\Spaces;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class SpacesLookup extends ApiBase
{
    /**
     * The endpoint base
     *
     * @var string
     */
    protected string $endpoint_base = 'spaces';

    /**
     * Tokens and secrets
     *
     * @var array
     */
    protected array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Returns a variety of information about a single Space
     * specified by the requested ID
     *
     * @param string $space_id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getSpace(string $space_id, array $params = []): object
    {
        $path = $this->endpoint_base . '/' . $space_id;
        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Returns details about multiple Spaces
     *
     * @param array $space_ids - max 100 space ids
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getSpaces(array $space_ids, array $params = []): object
    {
        $path = $this->endpoint_base;
        $params['ids'] = join(',', $space_ids);

        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Returns live or scheduled Spaces created by the specified user IDs
     *
     * @param array $user_ids - max 100 user ids
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function discover(array $user_ids, array $params = []): object
    {
        $path = $this->endpoint_base . '/by/creator_ids';
        $params['user_ids'] = join(',', $user_ids);

        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Get spaces owned by one user
     *
     * @param string $user_name - the username
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getByUser(string $user_name, array $params = []): object
    {
        $path = $this->endpoint_base . '/by/creator_ids';
        $id = $this->getUserId($user_name);
        $params['user_ids'] = $id;

        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Returns a list of user who purchased a ticket to the
     * requested Space. You must authenticate the request using
     * the Access Token of the creator of the requested Space.
     *
     * @param string $space_id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function buyers(string $space_id, array $params = []): object
    {
        $path = $this->endpoint_base . '/' . $space_id . '/buyers';
        return $this->get($this->credentials, $path, $params, null, false, true);
    }
}
