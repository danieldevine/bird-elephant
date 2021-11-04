<?php

namespace Coderjerk\BirdElephant\Users;

use Coderjerk\BirdElephant\ApiBase;

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

    public function follow($target_list_id)
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/followed_lists";
        $data = [
            'list_id' => $target_list_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    public function unfollow($target_list_id)
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/followed_lists/{$target_list_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }

    public function pin($target_list_id)
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/pinned_lists";
        $data = [
            'list_id' => $target_list_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    public function unpin($target_list_id)
    {
        $id = $this->getUserId($this->username);
        $path = "users/{$id}/pinned_lists/{$target_list_id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
