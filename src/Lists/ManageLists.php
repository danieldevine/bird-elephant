<?php

namespace Coderjerk\ElephantBird\Lists;

use Coderjerk\ElephantBird\ApiBase;

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
     * @param string $description
     * @param boolean $private
     * @return object|exception
     */
    public function createList($name, $description = false, $private = false)
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
     * @param string $description
     * @param boolean $private
     * @return object|exception
     */
    public function updateList($id, $name, $description = false, $private = false)
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
     * @return object|exception
     */
    public function deleteList($id)
    {
        $path = "lists/{$id}";

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
