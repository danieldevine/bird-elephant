<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Lists extends ApiBase
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

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
    }

    /**
     * @param string $target_list_id
     * @return object
     * @throws GuzzleException
     */
    public function follow(string $target_list_id): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/followed_lists";
        $data = [
            'list_id' => $target_list_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * @param string $target_list_id
     * @return object
     * @throws GuzzleException
     */
    public function unfollow(string $target_list_id): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/followed_lists/{$target_list_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }

    /**
     * @param string $target_list_id
     * @return object
     * @throws GuzzleException
     */
    public function pin(string $target_list_id): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/pinned_lists";
        $data = [
            'list_id' => $target_list_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * @param string $target_list_id
     * @return object
     * @throws GuzzleException
     */
    public function unpin(string $target_list_id): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/pinned_lists/{$target_list_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }

    /**
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function pinned(array $params = []): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/pinned_lists";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function followed(array $params = []): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/followed_lists";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function owned(array $params = []): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/owned_lists";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * Returns all Lists a specified user is a member of
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function memberships(array $params = []): object
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/list_memberships";

        return $this->get($this->credentials, $path, $params, null, false, true);
    }
}
