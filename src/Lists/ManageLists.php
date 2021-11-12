<?php

namespace Coderjerk\BirdElephant\Lists;

use Coderjerk\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class ManageLists extends ApiBase
{

    protected array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Create a list
     *
     * @param string $name
     * @param string $description
     * @param boolean $private
     * @return object
     * @throws GuzzleException
     */
    public function createList(string $name,  $description = false, bool $private = false): object
    {
        $data = [
            'name' => $name,
            'private' => $private
        ];

        if ($description) {
            $data['description'] = $description;
        }

        $path = 'lists';

        return $this->post($this->credentials, $path, null, $data, false, true);
    }


    /**
     * Update a list that is owned by the authorised user
     *
     * @param string $id
     * @param string $name
     * @param $description
     * @param boolean $private
     * @return object
     * @throws GuzzleException
     */
    public function updateList(string $id, string $name, $description = false, bool $private = false): object
    {
        $data = [
            'name' => $name,
            'private' => $private
        ];

        if ($description) {
            $data['description'] = $description;
        }

        $path = "lists/{$id}";

        return $this->put($this->credentials, $path, null, $data, false, true);
    }

    /**
     * Delete a list owned by the authenticated user
     *
     * @param string $id
     * @return object
     * @throws GuzzleException
     */
    public function deleteList(string $id): object
    {
        $path = "lists/{$id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
