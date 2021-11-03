<?php

namespace Coderjerk\ElephantBird\Spaces;

use Coderjerk\ElephantBird\ApiBase;

class SpacesLookup extends ApiBase
{
    /**
     * The endpoint base
     *
     * @var string
     */
    protected $endpoint_base = 'spaces';

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
     * @return object|exception
     */
    public function getSpace(string $space_id, array $params)
    {
        $path = $this->endpoint_base . '/' . $space_id;
        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Returns details about multiple Spaces
     *
     * @param array $space_ids - max 100 space ids
     * @return object|exception
     */
    public function getSpaces(array $space_ids, array $params)
    {
        $path = $this->endpoint_base;
        $this->params['ids'] = join(',', $space_ids);

        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Returns live or scheduled Spaces created by the specified user IDs
     *
     * @param array $user_ids - max 100 user ids
     * @return object|exception
     */
    public function discover(array $user_ids, array $params)
    {
        $path = $this->endpoint_base . '/by/creator_ids';
        $this->params['user_ids'] = join(',', $user_ids);

        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Get spaces owned by one user
     *
     * @param string $user_name - the user name
     * @param array $params
     * @return object|exception
     */
    public function getByUser(string $user_name, array $params)
    {
        $path = $this->endpoint_base . '/by/creator_ids';
        $id = $this->getUserId($user_name);
        $params['user_ids'] = [$id];

        return $this->get($this->credentials, $path, $params);
    }
}
