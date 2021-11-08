<?php

namespace Coderjerk\BirdElephant\Lists;

use Coderjerk\BirdElephant\ApiBase;

/**
 * Undocumented class
 */
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
     * @param bool|string $description
     * @param boolean $private
     * @return object
     */
    public function createList(string $name, bool|string $description = false, bool $private = false): object
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
     * @param bool|string $description
     * @param boolean $private
     * @return object
     */
    public function updateList(string $id, string $name, bool|string $description = false, bool $private = false): object
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
     * Deletes a list owned by the authenticated user
     *
     * @param string $id
     * @return object
     */
    public function deleteList(string $id): object
    {
        $path = "lists/{$id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
